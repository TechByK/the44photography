<?php
// manage_users.php: View and manage user accounts.
include('../includes/auth.php');
include('../includes/db.php');
$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <h2>Manage Users</h2>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>Role</th>
    </tr>
    <?php while ($user = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $user['id'] ?></td>
      <td><?= htmlspecialchars($user['username']) ?></td>
      <td><?= htmlspecialchars($user['role']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
