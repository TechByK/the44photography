<?php
// auth.php: Session and authentication check.
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /the44photography/login.php");
    exit();
}
?>
