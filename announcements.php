<?php
require "require/announcementBack.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="assets/icon.png">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/announcements.css">
</head>

<body>
    <?php
    require "require/sidebar.php";
    ?>
    <main>
        <div class="header">
            <h1><?php $_SESSION['loggedIn'] == "admin"?"Manage ":"";?>Announcement</h1>
            <?php
            if ($_SESSION['loggedIn'] == "admin") {
                echo '<button class="add-member-btn view-all-btn" onclick="openAnnouncementModal()"><i class="fas fa-plus"></i> Add announcement</button>';
            } ?>
        </div>

        <div class="announcements-list">

            <?php
            // Fetch announcements
            $sql = "SELECT * FROM announcements ORDER BY created_at DESC";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <div class='announcement-container'>
                        <div class='announcement-header'>
                            <div class='meta-info'>
                                <div class='btn-edit'>
                                    " . getCategoryIcon($row['category']) . " " . ucwords(str_replace('_', ' ', $row['category'])) . "
                                </div>";
                    if ($_SESSION['loggedIn'] == "admin") {
                        echo "
                                <div class='action-buttons'>
                                    <button class='btn-edit' onclick='editAnnouncement(this, " . $row['id'] . ")'>
                                        <i class='fas fa-edit'></i>
                                        Edit
                                    </button>
                                    <button class='btn-delete' onclick='openDeleteModal(" . $row['id'] . ")'>
                                        <i class='fas fa-trash-alt'></i>
                                        Delete
                                    </button>
                                </div>";
                    }
                    echo "
                            </div>
                            <div class='announcement-title'>
                                <h2>" . htmlspecialchars($row['title']) . "</h2>
                                <time class='date' datetime='" . htmlspecialchars($row['created_at']) . "'>Posted: " . date('Y-m-d', strtotime($row['created_at'])) . "</time>
                            </div>
                        </div>
                        <div class='announcement-body'>" . nl2br(htmlspecialchars($row['content'])) . "</div>
                    </div>";
                }
            } else {
                echo '<p>No announcements found.</p>';
            }
            ?>
        </div>

        <!-- Add/Edit Modal -->
        <div id="announcementModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('announcementModal')">&times;</span>
                <h2 id="modalTitle">Add New Announcement</h2>
                <form id="announcementForm" method="POST">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="id" id="announcementId">

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="event">Events</option>
                            <option value="equipment_update">Equipment Update</option>
                            <option value="health_and_safety">Health and Safety</option>
                            <option value="notice">Notices</option>
                            <option value="achievement">Achievements</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" required></textarea>
                    </div>
                    <button type="submit" class="view-all-btn" id="submitButton"><i class="fas fa-plus"></i> Add Announcement</button>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('deleteModal')">&times;</span>
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this announcement?</p>
                <form method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="announcementId" id="deleteId">
                    <div class="form-group" style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button type="button" onclick="closeModal('deleteModal')" class="btn-edit">Cancel</button>
                        <button type="submit" class="btn-delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="js/announcement.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>