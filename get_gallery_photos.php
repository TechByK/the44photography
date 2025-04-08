<?php
// get_gallery_photos.php: Returns JSON data for all gallery photos.
include('includes/db.php');
header('Content-Type: application/json');
$photos = [];
$result = $conn->query("SELECT * FROM photos");
while ($row = $result->fetch_assoc()) {
    $photos[] = $row;
}
echo json_encode($photos);
?>
