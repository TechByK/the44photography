<?php
// featured.php: Manage featured photos.
include('../includes/auth.php');
include('../includes/db.php');

// If POST, update featured status:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Reset all to not featured
    $conn->query("UPDATE photos SET featured=0");
    // Get array of photo ids to feature:
    $featured_ids = $_POST['featured'] ?? [];
    foreach ($featured_ids as $id) {
        $id_int = intval($id);
        $conn->query("UPDATE photos SET featured=1 WHERE id = $id_int");
    }
}
$result = $conn->query("SELECT * FROM photos");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Featured Photos - Admin</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <h2>Manage Featured Photos</h2>
  <form method="post">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="photo-item">
          <img src="../assets/images/<?= $row['filename'] ?>" alt="<?= htmlspecialchars($row['caption']) ?>" width="100">
          <label>
              <input type="checkbox" name="featured[]" value="<?= $row['id'] ?>" <?= $row['featured'] ? 'checked' : '' ?>>
              <?= htmlspecialchars($row['caption']) ?>
          </label>
      </div>
    <?php endwhile; ?>
    <br>
    <input type="submit" value="Save Featured Photos">
  </form>
  <p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
