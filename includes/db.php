<?php
// db.php: Database connection using MySQLi.
$host = 'localhost';
$user = 'root';
$pass = ''; // XAMPP default; change if needed
$db   = 'the44photography';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
