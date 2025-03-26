<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anjaneya Arena | Account Access</title>
    <link rel="icon" href="assets/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/websiteMain.css">
</head>

<body>
    <?php
    session_start();
    require "require/loginBack.php";
    if (isset($_SESSION['message'])) {
        echo '<div class=" message alert-item success"><i class="fas fa-check"></i>' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="message alert-item failure "><i class="fas fa-ban"></i>' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
    <div class="container">
        <div class="header">
            <a class="flex" href="index.php">
                <img width="70" height="78" src="assets/logo.png" alt="Anjaneya Arena Logo" />
                <h1 class="ffCinzel brandName">Anjaneya<br />Arena</h1>
            </a>
            <p id="headerText">Welcome back!</p>
        </div>

        <div class="auth-card">
            <div class="flex tab-buttons">
                <button type="button" class="tab-button active" id="loginTab">Login</button>
                <button type="button" class="tab-button" id="registerTab">Register</button>
            </div>

            <form id="loginForm" method="post">
                <input type="hidden" name="action" value="login">
                <div class="form-group">
                    <input id="logMail" type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <input id="logPass" type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-button">
                    Login
                </button>
                <div class="toggle-text">
                    <span id="adminText">Are you admin?</span>
                    <button type="button" id="adminLogin">Login</button>
                </div>
            </form>

            <form id="registerForm" class="hidden" method="post">
                <input type="hidden" name="action" value="register">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input id="confirmPassword" type="password" placeholder="Confirm Password" required>
                    <p id=matchMessage>Password</p>
                </div>
                <button type="submit" class="submit-button">
                    Create Account
                </button>
            </form>

            <div class="toggle-text">
                <span id="toggleText">Don't have an account?</span>
                <button type="button" id="toggleButton">Register</button>
            </div>
        </div>
    </div>
    <script src="js/login.js"></script>
</body>

</html>