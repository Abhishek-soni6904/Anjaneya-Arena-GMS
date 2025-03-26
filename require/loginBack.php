<?php
require_once 'config.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); // Start the session

    switch ($_POST['action']) {
        case 'login':
            // Login logic
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $query = "SELECT * FROM members WHERE email = ?";
            $stmt = mysqli_prepare($connection, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    $member = mysqli_fetch_assoc($result);
                    if (password_verify($password, $member['password'])) {
                        $_SESSION['loggedIn'] = "member";
                        $_SESSION['member_id'] = $member['id'];
                        $_SESSION['message'] = "Login successful!";
                        header("Location: profile.php");
                        exit();
                    }
                }
                $_SESSION['error'] = "Invalid email or password!";
                mysqli_stmt_close($stmt);
            }
            break;

        case 'admin':
            $_SESSION['loggedIn'] = "admin";
            $_SESSION['message'] = "Login Successful";
            header("Location: admin.php");
            exit();
            break;

        case 'register':
            // Registration logic
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Check if email already exists
            $check_email_query = "SELECT id FROM members WHERE email = ?";
            $stmt = mysqli_prepare($connection, $check_email_query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $_SESSION['error'] = "Email already registered!";
                    mysqli_stmt_close($stmt);
                    break;
                }
                mysqli_stmt_close($stmt);
            }

            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO members (name, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($connection, $insert_query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashed_password);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['loggedIn'] = "member";
                    $_SESSION['member_id'] = mysqli_insert_id($connection);
                    $_SESSION['message'] = "Registration successful! Welcome to our fitness community!";
                    header("Location: profile.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Registration failed! Please try again.";
                }
                mysqli_stmt_close($stmt);
            }
            break;

        default:
            $_SESSION['error'] = "Invalid action!";
            break;
    }

    // Redirect to the same page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
