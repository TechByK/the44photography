<?php
// login.php: Login form and authentication handler.
include('includes/db.php');
session_start();

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // In production use password_hash() and password_verify()
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $message = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - The 44 Photography</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h2>Login</h2>
  <?php if ($message) { echo "<p>$message</p>"; } ?>
  <form method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
  </form>
</body>
</html>
