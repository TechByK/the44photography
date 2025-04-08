<?php
// delete_photo.php: Deletes a photo record and its file.
// Requires a query parameter: id
include('../includes/auth.php');
include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Get file name to delete the image file from disk:
    $stmt = $conn->prepare("SELECT filename FROM photos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($photo = $result->fetch_assoc()) {
        $filePath = "../assets/images/" . $photo['filename'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    // Delete from database:
    $stmt = $conn->prepare("DELETE FROM photos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: dashboard.php");
exit();
?>
