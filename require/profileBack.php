<?php
session_start();
require_once 'require/config.php';
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== "member") {
    header("Location: login.php");
    exit();
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
// Fetch member details
$id = $_SESSION['member_id'];
$stmt = mysqli_prepare($connection, "SELECT * FROM members WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$member = mysqli_fetch_assoc($result);

// Handle name/email updates
if (isset($_POST['editType']) && isset($_POST['newValue'])) {
    $type = $_POST['editType'];
    $value = trim($_POST['newValue']);

    if ($type === 'Name' || $type === 'Email') {
        // Check if the email is already registered
        if ($type === 'Email') {
            $stmt = mysqli_prepare($connection, "SELECT COUNT(*) FROM members WHERE email = ? AND id != ?");
            mysqli_stmt_bind_param($stmt, "si", $value, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);

            if ($row['COUNT(*)'] > 0) {
                $_SESSION['error'] = "This email is already registered by another member!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        }

        $stmt = mysqli_prepare($connection, "UPDATE members SET $type = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $value, $id);
        if (mysqli_stmt_execute($stmt)) {
            if ($type === 'Email') {
                $_SESSION['email'] = $value;
            }
            $_SESSION['message'] = ucfirst($type) . " updated successfully!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['error'] = "Error updating " . $type;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

if (isset($_POST['duration']) && is_numeric($_POST['duration']) && $_POST['duration'] > 0) {
    $duration = (int)$_POST['duration'];
    $payMode = $_POST['paymentMethod'];
    $existingExpirationDate = $member['expiration_date'];
    $total = getMembershipPrice($member['membership_type']) * $duration;
    $action = 'Membership Extend';

    $stmt = mysqli_prepare($connection, "UPDATE members SET expiration_date = DATE_ADD(expiration_date, INTERVAL ? MONTH) WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $duration, $id);
    $payStmt = mysqli_prepare($connection, "INSERT INTO payments (memberId, action, duration, new, changedFrom, payMode, Total) VALUES (?, ?, ?, DATE_ADD(?, INTERVAL ? month), ?, ?, ?)");
    mysqli_stmt_bind_param($payStmt, "isisissi", $id, $action, $duration, $existingExpirationDate, $duration, $existingExpirationDate, $payMode, $total);
    mysqli_stmt_execute($payStmt);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Expiration date extended successfully!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
// Handle password update
if (isset($_POST['currentPassword']) && isset($_POST['newPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error'] = "New passwords do not match!";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        if (password_verify($currentPassword, $member['password'])) {
            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($connection, "UPDATE members SET password = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Password updated successfully!";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            $_SESSION['error'] = "Current password is incorrect!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// Handle membership update
if (isset($_POST['newMembership']) && isset($_POST['membershipDuration'])) {
    $existingMembershipType = $member['membership_type'];
    $newMembership = $_POST['newMembership'];
    $duration = (int)$_POST['membershipDuration'];
    $payMode = $_POST['paymentMethod'];
    $total = getMembershipPrice($newMembership) * $duration;
    $action = 'Membership Change';
    if ($newMembership === $existingMembershipType) {
        $_SESSION['error'] = 'Existing Membership Type matches the New Type. Use the Extend button to renew or extend.';
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
    $stmt = mysqli_prepare($connection, "UPDATE members SET membership_type = ?, expiration_date = DATE_ADD(CURRENT_DATE, INTERVAL ? MONTH) WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sii", $newMembership, $duration, $id);

    $payStmt = mysqli_prepare($connection, "INSERT INTO payments (memberId, action, duration, new, changedFrom, payMode, Total) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($payStmt, "isisssi", $id, $action, $duration, $newMembership, $existingMembershipType, $payMode, $total);
    mysqli_stmt_execute($payStmt);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['membership_type'] = $newMembership;
        $_SESSION['message'] = "Membership Changed successfully!. You can get Receipt from Transaction Section.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['error'] = "Error updating membership";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
