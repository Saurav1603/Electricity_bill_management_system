<?php
// Database Connection (db.php)
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'electricity_bill_db';
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
