<?php
// add_photo.php: Allows admin/photographer to upload a photo.
include('../includes/auth.php');
include('../includes/db.php');

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caption = $_POST['caption'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;

    // Set target directory (ensure this folder is writable)
    $target = "../assets/images/" . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {
        $file = basename($_FILES["image"]["name"]);
        $stmt = $conn->prepare("INSERT INTO photos (filename, caption, featured) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $file, $caption, $is_featured);
        if ($stmt->execute()) {
            $message = "Photo uploaded successfully.";
        } else {
            $message = "Database error: " . $conn->error;
        }
    } else {
        $message = "Failed to upload the file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Photo - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <h2>Add a New Photo</h2>
  <?php if ($message) { echo "<p>$message</p>"; } ?>
  <form method="post" enctype="multipart/form-data">
      <label>Image: <input type="file" name="image" required></label><br>
      <label>Caption: <input type="text" name="caption" required></label><br>
      <label><input type="checkbox" name="is_featured"> Set as Featured</label><br>
      <input type="submit" value="Upload Photo">
  </form>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
