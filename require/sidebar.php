<?php
// Get the current file name
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav id="sidebar" class="close">
    <ul>
        <li>
            <div class="logo">
                <img width="40px" src="assets/logo.png" alt="Anjaneya Arena Logo">
                <span>Anjaneya<br />Arena</span>
            </div>
            <button id="toggle-btn">
                <i class="fas fa-angles-left"></i>
            </button>
        </li>
        <li <?php echo ($currentPage == 'admin.php' || $currentPage == 'profile.php') ? 'class="active"' : ''; ?>>
            <a href="<?php echo $_SESSION['loggedIn'] === 'admin' ? 'admin.php' : 'profile.php'; ?>">
                <i data-tooltip="Home" class="fas fa-home"></i>
                <span>Home</span>
            </a>
        </li>

        <?php
        if ($_SESSION['loggedIn'] === 'admin') {
            echo '<li';
            echo ($currentPage == 'manageMembers.php') ? ' class="active"'  : '';
            echo '><a href="manageMembers.php">
                <i data-tooltip="Members" class="fas fa-users"></i>
                <span>Members</span>
                </a>
            </li>';
        }
        ?>
        <li <?php echo ($currentPage == 'announcements.php') ? 'class="active"'  : ''; ?>>
            <a href="announcements.php">
                <i data-tooltip="Announcements" class="fas fa-bullhorn"></i>
                <span>Announcements</span>
            </a>
        </li>
        <li <?php echo ($currentPage == 'transactions.php') ? 'class="active"'  : ''; ?>>
            <a href="transactions.php">
            <i data-tooltip="Transactions" class="fa-solid fa-money-bill-transfer"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li>
            <a href="require/logout.php">
                <i data-tooltip="logout" class="fas fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<div class=" message alert-item success"><i class="fas fa-check"></i>' . $_SESSION['message'] . '</div>';
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="message alert-item failure "><i class="fas fa-ban"></i>' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>
</nav>