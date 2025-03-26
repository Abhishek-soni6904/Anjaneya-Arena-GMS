<?php
require_once 'require/config.php';

session_start();
if (!isset($_SESSION['loggedIn']) || ($_SESSION['loggedIn'] !== "admin")) {
    $_SESSION['error'] = "Unauthorized access";
    header("Location: login.php");
    exit;
}
function getMembershipPrice($membershipType)
{
    $prices = [
        'Basic' => 999,
        'Premium' => 1999,
        'Elite' => 2999,
        'Ultimate' => 3999
    ];
    return isset($prices[$membershipType]) ? $prices[$membershipType] : 0;
}
// Function to check if email exists
function checkEmailExists($connection, $email, $member_id = null)
{
    $query = "SELECT id FROM members WHERE email = ?";
    $params = array($email);

    if ($member_id) {
        $query .= " AND id != ?";
        $params[] = $member_id;
    }

    $stmt = mysqli_prepare($connection, $query);
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $name = trim($_POST['memberName']) ?? null;
        $membershipType = trim($_POST['membershipType']) ?? null;
        $email = trim($_POST['email']) ?? null;
        $password = trim($_POST['password']) ?? null;
        $duration = trim($_POST['membershipDuration']) ?? null;
        $payMode = trim($_POST['paymentMethod']) ?? null;
        $message = null;
        $error = null;

        switch ($_POST['action']) {
            case 'add':
                if (checkEmailExists($connection, $email)) {
                    $error = "This email is already registered by another member!";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $action = 'New Member';
                    $total = getMembershipPrice($membershipType) * $duration;

                    $stmt = mysqli_prepare(
                        $connection,
                        "INSERT INTO members (name, membership_type, email, password, join_date, expiration_date) 
                         VALUES (?, ?, ?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL $duration month))"
                    );

                    mysqli_stmt_bind_param($stmt, "ssss", $name, $membershipType, $email, $hashedPassword);
                    if (mysqli_stmt_execute($stmt)) {
                        $id = mysqli_insert_id($connection);
                        $message = "Member added successfully!";
                    } else {
                        $error = "Failed to add member!";
                    }
                    $payStmt = mysqli_prepare($connection, "INSERT INTO payments (memberId, action, duration, new, payMode, Total) VALUES (?, ?, ?, ?, ?, ?)");
                    mysqli_stmt_bind_param($payStmt, "isissi", $id, $action, $duration, $membershipType, $payMode, $total);
                    mysqli_stmt_execute($payStmt);
                }
                break;

            case 'update':
                $id = $_POST['member_id'];
                if (checkEmailExists($connection, $email, $id)) {
                    $error = "This email is already registered by another member!";
                } else {
                    $result = mysqli_query($connection, "SELECT expiration_date, password, membership_type FROM members WHERE id = $id");
                    $row = mysqli_fetch_assoc($result);
                    $existingExpirationDate = $row['expiration_date'];
                    $existingPassword = $row['password'];
                    $existingMembershipType = $row['membership_type'];
                    $total = getMembershipPrice($membershipType) * $duration;

                    $hashedPassword = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $existingPassword;

                    // If membership type changes, we can update the expiration date
                    if ($membershipType != $existingMembershipType) {
                        $action = 'Membership Change';
                        $stmt = mysqli_prepare($connection, "UPDATE members SET name = ?, membership_type = ?, email = ?, password = ?, expiration_date = DATE_ADD(CURDATE(), INTERVAL ? month) WHERE id = ?");
                        mysqli_stmt_bind_param($stmt, "ssssii", $name, $membershipType, $email, $hashedPassword, $duration, $id);
                        $payStmt = mysqli_prepare($connection, "INSERT INTO payments (memberId, action, duration, new, changedFrom, payMode, Total) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        mysqli_stmt_bind_param($payStmt, "isisssi", $id, $action, $duration, $membershipType, $existingMembershipType, $payMode, $total);
                        mysqli_stmt_execute($payStmt);
                    } else {
                        $action = 'Membership Extend';
                        $stmt = mysqli_prepare($connection, "UPDATE members SET name = ?, membership_type = ?, email = ?, password = ?, expiration_date = DATE_ADD(?, INTERVAL ? month) WHERE id = ?");
                        mysqli_stmt_bind_param($stmt, "sssssii", $name, $membershipType, $email, $hashedPassword, $existingExpirationDate, $duration, $id);
                        if ($duration > 0) {
                            $payStmt = mysqli_prepare($connection, "INSERT INTO payments (memberId, action, duration, new, changedFrom, payMode, Total) VALUES (?, ?, ?, DATE_ADD(?, INTERVAL ? month), ?, ?, ?)");
                            mysqli_stmt_bind_param($payStmt, "isisissi", $id, $action, $duration, $existingExpirationDate, $duration, $existingExpirationDate, $payMode, $total);
                            mysqli_stmt_execute($payStmt);
                        }
                    }

                    if (mysqli_stmt_execute($stmt)) {
                        $message = "Member updated successfully!";
                    } else {
                        $error = "Failed to update member!";
                    }
                }
                break;


            case 'delete':
                $id = $_POST['member_id'];
                $stmt = mysqli_prepare($connection, "DELETE FROM members WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "i", $id);

                if (mysqli_stmt_execute($stmt)) {
                    $message = "Member deleted successfully!";
                } else {
                    $error = "Failed to delete member!";
                }
                break;
        }

        // Set session message or error
        if ($message) {
            $_SESSION['message'] = $message;
        } elseif ($error) {
            $_SESSION['error'] = $error;
        }

        // Redirect to the same page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch all members
$query = "SELECT * FROM members ORDER BY id DESC";
$result = mysqli_query($connection, $query);
