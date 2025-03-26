<?php
// Database connection
$host = 'localhost';
$username = 'root';  
$password = '';      
$database = 'anjaneya_arena';

$connection = mysqli_connect($host, $username, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>