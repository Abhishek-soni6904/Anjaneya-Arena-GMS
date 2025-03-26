<?php

$sql = "UPDATE members SET membership_type = 'Expired' WHERE expiration_date < CURDATE() AND membership_type != 'Expired'";

if (!mysqli_query($connection, $sql)) {
    echo "❌ Error: " . mysqli_error($connection);}
?>
