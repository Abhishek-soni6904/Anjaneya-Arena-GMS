<?php require 'require/profileBack.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="assets/icon.png">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <?php
    require 'require/sidebar.php';
    $selectedMembership = isset($_GET['membership']) ? $_GET['membership'] : '';
    ?>
    <main>
        <div class="header">
            <h1>Your Details</h1>
        </div>

        <div class="member-details">
            <div class="detail-item">
                <span class="label">Join Date:</span>
                <span class="value"><?php echo date('d/m/Y', strtotime($member['join_date'])); ?></span>
            </div>
            <div class="detail-item">
                <span class="label">Name:</span>
                <span class="value"><?php echo htmlspecialchars($member['name']); ?></span>
                <button class="btn-edit" onclick="openEditModal('Name')">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>

            <div class="detail-item">
                <span class="label">Email:</span>
                <span class="value"><?php echo htmlspecialchars($member['email']); ?></span>
                <button class="btn-edit" onclick="openEditModal('Email')">
                    <i class="fas fa-edit"></i> Edit
                </button>
            </div>

            <div class="detail-item">
                <span class="label">Membership Type:</span>
                <span class="value"><?php echo htmlspecialchars($member['membership_type'] ?? 'Not Enrolled'); ?></span>
                <button class="btn-edit" onclick="openModal('membershipModal')">
                    <i class="fas fa-exchange-alt"></i> Change
                </button>
            </div>
            <div class="detail-item">
                <span class="label">Expiration Date:</span>
                <span class="value"><?php echo (($member['expiration_date'] == NULL) ? 'Not Enrolled' : date('d/m/Y', strtotime($member['expiration_date']))); ?></span>
                <?php
                if ($member['membership_type']) {
                    echo '<button class="btn-edit" onclick="openModal(\'expModal\')"><i class="fas fa-calendar-plus"></i> Extend</button>';
                }
                ?>
            </div>

            <button class="action-btn" onclick="openModal('passwordModal')">
                <i class="fas fa-key"></i> Update Password
            </button>
        </div>

        <!-- Generic Edit Modal for Name, Email and Extending exp_date -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('editModal')">&times;</span>
                <h2 id="editModalTitle">Update Field</h2>
                <form method="POST">
                    <input type="hidden" id="editType" name="editType">
                    <div class="form-group">
                        <label id="editFieldLabel">Field</label>
                        <input type="text" id="editFieldInput" name="newValue" required>
                    </div>
                    <button type="submit" class="btn-edit">Update</button>
                </form>
            </div>
        </div>
        <!-- Expiration date update Modal -->
        <div id="expModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('expModal')">&times;</span>
                <h2>Extend Membership by</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="duration">Enter in Months</label>
                        <input type="number" id="duration" name="duration" min="1" list="membership-duration-options" required>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method</label>
                        <select name="paymentMethod" required>
                            <option value="CreditCard">Credit Card</option>
                            <option value="DebitCard">Debit Card</option>
                            <option value="UPI">UPI</option>
                            <option value="NetBanking">Net Banking</option>
                            <option value="PayPal">PayPal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-edit">Extend</button>
                </form>
            </div>
        </div>


        <!-- Membership Modal -->
        <div id="membershipModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('membershipModal')">&times;</span>
                <h2>Update Membership</h2>
                <form method="POST" id="membershipForm">
                    <div class="form-group">
                        <label for="newMembership">New Membership Type</label>
                        <select id="newMembership" name="newMembership" required>
                        <option value="Basic" <?php echo $selectedMembership === 'Basic' ? 'selected' : ''; ?>>Basic - ₹999/month</option>
                            <option value="Premium" <?php echo $selectedMembership === 'Premium' ? 'selected' : ''; ?>>Premium - ₹1999/month</option>
                            <option value="Elite" <?php echo $selectedMembership === 'Elite' ? 'selected' : ''; ?>>Elite - ₹2999/month</option>
                            <option value="Ultimate" <?php echo $selectedMembership === 'Ultimate' ? 'selected' : ''; ?>>Ultimate - ₹3999/month</option>
                        </select>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="membershipDuration">Membership Duration</label>
                        <input type="number" min="1" id="membershipDuration" name="membershipDuration" placeholder="Enter in months." list="membership-duration-options" required>
                        <datalist id="membership-duration-options">
                            <option value="3">3</option>
                            <option value="6">6</option>
                            <option value="12">12</option>
                        </datalist>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method</label>
                        <select id="paymentMethod" name="paymentMethod" required>
                            <option value="CreditCard">Credit Card</option>
                            <option value="DebitCard">Debit Card</option>
                            <option value="UPI">UPI</option>
                            <option value="NetBanking">Net Banking</option>
                            <option value="PayPal">PayPal</option>
                        </select>
                    </div>
                    <p>If you change membership no refunds will be given</p>
                    <div>
                        <button type="submit" class="btn-edit">Pay Now</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Modal -->
        <div id="passwordModal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="closeModal('passwordModal')">&times;</span>
                <h2>Update Password</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <p id="matchMessage"></p>
                    <button type="submit" id="submit-btn" class="btn-edit">Update Password</button>
                </form>
            </div>
        </div>
    </main>
    <script src="js/dashboard.js"></script>
    <script src="js/profile.js"></script>
</body>

</html>