<?php
require 'require/config.php';
$announceSql = "SELECT title, created_at FROM announcements ORDER BY created_at DESC LIMIT 4";
$announcements = mysqli_query($connection, $announceSql);
$transactionsql = "SELECT payments.id, payments.total, members.name as memberName
                  FROM payments
                  LEFT JOIN members ON payments.memberId = members.id
                  ORDER BY payments.id DESC LIMIT 4;";
$transactions = mysqli_query($connection, $transactionsql);
$sql = "
SELECT 
    (SELECT COUNT(*) FROM members) AS totalMembers,
    (SELECT COUNT(*) FROM members WHERE membership_type = 'Expired' OR membership_type IS NULL) AS expiredMemberships,
    (SELECT COUNT(*) FROM members WHERE membership_type != 'Expired' AND membership_type IS NOT NULL) AS activeMemberships,
    (SELECT SUM(total) FROM payments WHERE payDate >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)) AS last30daystotal";
$result = mysqli_query($connection, $sql);

// Check if query was successful
if (!$result) {
  die('Something went wrong!');
} else {
  $data = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/dashboard.css">
  <link rel="icon" href="assets/icon.png">
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['loggedIn']) || ($_SESSION['loggedIn'] !== "admin")) {
    $_SESSION['error'] = "Unauthorized access";
    header("Location:login.php");
    exit;
  }
  require "require/sidebar.php"; ?>
  <main>
    <div class="header">
      <h1>Admin Panel</h1>
    </div>
    <div class="stats-container">
      <div class="stat-card">
        <div class="stat-content">
          <div class="stat-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-info">
            <h3>Total Members</h3>
            <p class="stat-value"><?php echo $data['totalMembers']; ?></p>
          </div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <div class="stat-icon">
            <i class="fas fa-indian-rupee-sign"></i>
          </div>
          <div class="stat-info">
            <h3>Total of Transactions of Last 30 Days</h3>
            <p class="stat-value">₹ <?php echo number_format($data['last30daystotal']); ?></p>
          </div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <div class="stat-icon">
            <i class="fas fa-user-check"></i>
          </div>
          <div class="stat-info">
            <h3>Active Memberships</h3>
            <p class="stat-value"><?php echo $data['activeMemberships']; ?></p>
          </div>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <div class="stat-icon">
            <i class="fas fa-user-clock"></i>
          </div>
          <div class="stat-info">
            <h3>Expired and Not Enrolled Members</h3>
            <p class="stat-value"><?php echo  $data['expiredMemberships']; ?></p>
            <p class="stat-value"><?php ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="content-grid">
      <div class="glass-effect">
        <div class="section-header">
          <h2>Announcements</h2>
          <button class="view-all-btn"><a href="announcements.php">Manage</a></button>
        </div>
        <div class="list">
          <?php
          if (mysqli_num_rows($announcements) > 0) {
            while ($row = mysqli_fetch_assoc($announcements)) {
              echo '<div class="item">';
              echo '<div class="icon">';
              echo '<i class="fas fa-bullhorn"></i>';
              echo '</div>';
              echo '<div class="content">';
              echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
              echo '<p>' . date("M d, Y", strtotime($row['created_at'])) . '</p>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo '<p>No announcements found.</p>';
          }
          ?>
        </div>
      </div>

      <div class="glass-effect">
        <div class="section-header">
          <h2>Recent Transactions</h2>
          <button class="view-all-btn"><a href="transactions.php">View All</a></button>
        </div>
        <div class="list">
          <?php
          if (mysqli_num_rows($transactions) > 0) {
            while ($row = mysqli_fetch_assoc($transactions)) {
              echo '<div class="item">';
              echo '<div class="icon">';
              echo '<i class="fas fa-indian-rupee-sign"></i>';
              echo '</div>';
              echo '<div class="content">';
              echo '<h3>' . htmlspecialchars($row['memberName']) . '</h3>';
              echo '<p>₹ ' . ($row['total']) . '</p>';
              echo '</div>';
              echo '</div>';
            }
          } else {
            echo '<p>No announcements found.</p>';
          }
          ?>
        </div>
      </div>
    </div>
  </main>
  <script src="js/dashboard.js"></script>
</body>

</html>