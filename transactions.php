<?php
require_once 'require/config.php';
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header('location: login.php');
    $_SESSION['error'] = 'Unauthorized access';
    exit();
}
// Fetch all payments with member details
if ($_SESSION['loggedIn'] === 'admin') {
    $query = "SELECT payments.*, members.name as memberName
            FROM payments
            LEFT JOIN members ON payments.memberId = members.id
            ORDER BY payments.id DESC;";
} else if ($_SESSION['loggedIn'] === 'member') {
    $query = "SELECT payments.*, members.name as memberName
            FROM payments
            LEFT JOIN members ON payments.memberId = members.id
            WHERE payments.memberId =" . $_SESSION['member_id'] . "
            ORDER BY payments.id DESC;";
}
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="css/manageMember.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/transactions.css">
    <link rel="icon" href="assets/icon.png">
</head>

<body>
    <?php require "require/sidebar.php"; ?>
    <main>
        <div class="header">
            <h1>Transaction History</h1>
        </div>
        <table id="jquery-data-table" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member Name</th>
                    <th>Action</th>
                    <th>New</th>
                    <th>Changed From</th>
                    <th>Payment Mode</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>" . htmlspecialchars($row['id']) . "</td>
                        <td>" . htmlspecialchars($row['memberName']) . "</td>
                        <td>" . htmlspecialchars($row['action']) . "</td>
                        <td>" . htmlspecialchars($row['new']) . "</td>
                        <td>" . htmlspecialchars($row['changedFrom']??'None') . "</td>
                        <td>" . htmlspecialchars($row['payMode']) . "</td>
                        <td>₹" . htmlspecialchars($row['Total']) . "</td>
                        <td>" . date('d/m/Y', strtotime($row['payDate'])) . "</td>
                        <td>
                            <button type='button' class='btn-edit' onclick='printReceipt(" . json_encode($row) . ")'>
                                <i class='fas fa-print'></i>
                            </button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Receipt Modal -->
        <div id="receiptModal" class="receipt-modal">
            <div class="receipt-content" id="receiptContent">
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="js/transactions.js"></script>
    <script src="js/dashboard.js"></script>
</body>

</html>