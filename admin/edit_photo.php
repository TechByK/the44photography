<?php
// edit_photo.php: Allows editing the caption of a photo.
// Expects a query parameter id.
include('../includes/auth.php');
include('../includes/db.php');

if (!isset($_GET['id'])) {
    die("No photo ID specified.");
}
$id = intval($_GET['id']);
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = $_POST['caption'];
    $stmt = $conn->prepare("UPDATE photos SET caption=? WHERE id=?");
    $stmt->bind_param("si", $caption, $id);
    if ($stmt->execute()) {
        $message = "Photo updated successfully.";
    } else {
        $message = "Update error: " . $conn->error;
    }
}

$stmt = $conn->prepare("SELECT * FROM photos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$photo = $stmt->get_result()->fetch_assoc();
if (!$photo) {
    die("Photo not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Photo - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <h2>Edit Photo</h2>
  <?php if ($message) { echo "<p>$message</p>"; } ?>
  <form method="post">
      <label>Caption: <input type="text" name="caption" value="<?= htmlspecialchars($photo['caption']) ?>" required></label><br>
      <input type="submit" value="Update Photo">
  </form>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
