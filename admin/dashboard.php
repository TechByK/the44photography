<?php
// dashboard.php
// Admin Dashboard - requires login
include('../includes/auth.php');
include('../includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - The 44 Photography</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <h1>Admin Dashboard</h1>
  <ul>
      <li><a href="add_photo.php">Add Photo</a></li>
      <li><a href="edit_photo.php?id=1">Edit Photo</a> <!-- Pass photo id via query string --></li>
      <li><a href="delete_photo.php?id=1">Delete Photo</a></li>
      <li><a href="featured.php">Manage Featured Photos</a></li>
      <li><a href="manage_users.php">Manage Users</a></li>
      <li><a href="../logout.php">Logout</a></li>
  </ul>
</body>
</html>
