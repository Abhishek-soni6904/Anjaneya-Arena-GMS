<?php
require 'require/manageMemberBack.php';
// require 'require/cron.php';  needed if events not supported
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="icon" href="assets/icon.png">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/manageMember.css">
</head>

<body>
    <?php
    require "require/sidebar.php";
    ?>
    <main>
        <div class="header">
            <h1>Manage Member</h1>
            <button class="add-member-btn view-all-btn" onclick="openMemberModal()">
                <i class="fas fa-plus"></i> Add Member
            </button>
        </div>
        <table id="jquery-data-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Member Name</th>
                    <th>Join Date</th>
                    <th>Membership</th>
                    <th>Expiration Date</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>" . $sno++ . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . date('d/m/Y', strtotime($row['join_date'])) . "</td>
                    <td>" . htmlspecialchars($row['membership_type'] ?? 'Not Enrolled') . "</td>
                    <td>" .
                        (($row['expiration_date'] == NULL) ? 'Not Enrolled' : date('d/m/Y', strtotime($row['expiration_date']))) .
                        "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td class='action-buttons'>
                        <button type='button' onclick='editMember( this.parentNode.parentNode," . $row['id'] . ")' class='btn-edit'>
                            <i class='fas fa-edit'></i> Edit
                        </button>
                        <button type='button' onclick='openDeleteModal(" . $row['id'] . ")' class='btn-delete'>
                            <i class='fas fa-trash'></i> Delete
                        </button>
                    </td>
                </tr>";
                } ?>
            </tbody>
        </table>

        <!-- Member Modal (Used for both Add and Edit) -->
        <div id="memberModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('memberModal')">&times;</span>
                <h2 id="modalTitle">Add New Member</h2>
                <form method="POST" id="memberForm">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="member_id" id="member_id">
                    <div class="form-group">
                        <label for="memberName">Member Name</label>
                        <input type="text" id="memberName" name="memberName" required>
                    </div>
                    <div class="form-group">
                        <label for="membershipType">Membership Type</label>
                        <select id="membershipType" name="membershipType" required>
                            <option value="Basic">Basic - ₹999</option>
                            <option value="Premium">Premium - ₹1999</option>
                            <option value="Elite">Elite - ₹2999</option>
                            <option value="Ultimate">Ultimate - ₹3999</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="membershipDuration">Membership Duration</label>
                        <input type="number" min="0" id="membershipDuration" name="membershipDuration" placeholder="Enter in months." list="membership-duration-options" required>
                        <datalist id="membership-duration-options">
                            <option value="3">3</option>
                            <option value="6">6</option>
                            <option value="12">12</option>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method</label>
                        <select id="paymentMethod" name="paymentMethod" required>
                            <option value="CreditCard">Credit Card</option>
                            <option value="DebitCard">Debit Card</option>
                            <option value="UPI">UPI</option>
                            <option value="NetBanking">Net Banking</option>
                            <option value="PayPal">PayPal</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword">
                        <small id="match"></small>
                    </div>
                    <button type="submit" class="add-member-btn view-all-btn" id="submitButton">
                        <i class="fas fa-plus"></i> <span>Add Member</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('deleteModal')">&times;</span>
                <h2>Confirm Delete</h2>
                <p>Are you sure you want to delete this member?</p>
                <form method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="member_id" id="delete_member_id">
                    <div class="form-group" style="display: flex; gap: 10px; justify-content: flex-end;">
                        <button type="button" onclick="closeModal('deleteModal')" class="btn-edit">Cancel</button>
                        <button type="submit" class="btn-delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/manageMember.js"></script>
</body>

</html>