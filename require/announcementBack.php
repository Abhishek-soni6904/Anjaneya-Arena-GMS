<?php
require_once "config.php";
session_start();
if(!isset($_SESSION['loggedIn'])){
    $_SESSION['error']="Unauthorized access";
      header("Location: login.php");
      exit;
  }

// Function to get icon based on category
function getCategoryIcon($category)
{
    $icons = [
        'event' => '<i class="fas fa-calendar-alt"></i>',
        'equipment_update' => '<i class="fas fa-dumbbell"></i>',
        'health_and_safety' => '<i class="fas fa-shield-heart"></i>',
        'notice' => '<i class="fas fa-bullhorn"></i>',
        'achievement' => '<i class="fas fa-trophy"></i>'
    ];
    return isset($icons[$category]) ? $icons[$category] : '<i class="fas fa-thumbtack"></i>';
}


// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $title = trim($_POST['title']) ?? null;
        $content = trim($_POST['content']) ?? null;
        $category = $_POST['category'] ?? null;
        $message = null;
        $error = null;

        switch ($_POST['action']) {
            case 'add':
                $stmt = mysqli_prepare($connection, "INSERT INTO announcements (title, content, category) VALUES (?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "sss", $title, $content, $category);

                if (mysqli_stmt_execute($stmt)) {
                    $message = "Announcement added successfully!";
                } else {
                    $error = "Error adding announcement.";
                }
                mysqli_stmt_close($stmt);
                break;

            case 'update':
                $id = $_POST['id'];
                $stmt = mysqli_prepare($connection, "UPDATE announcements SET title=?, content=?, category=? WHERE id=?");
                mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $category, $id);

                if (mysqli_stmt_execute($stmt)) {
                    $message = "Announcement updated successfully!";
                } else {
                    $error = "Error updating announcement.";
                }
                mysqli_stmt_close($stmt);
                break;

            case 'delete':
                $id = $_POST['announcementId'];
                $stmt = mysqli_prepare($connection, "DELETE FROM announcements WHERE id=?");
                mysqli_stmt_bind_param($stmt, "i", $id);

                if (mysqli_stmt_execute($stmt)) {
                    $message = "Announcement deleted successfully!";
                } else {
                    $error = "Error deleting announcement.";
                }
                mysqli_stmt_close($stmt);
                break;
        }
        if ($message) {
            $_SESSION['message'] = $message;
        } elseif ($error) {
            $_SESSION['error'] = $error;
        }
        $message = null;
        $error = null;

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>