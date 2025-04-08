<?php
// get_featured_photos.php: Returns JSON data for featured photos.
include('includes/db.php');
header('Content-Type: application/json');
$photos = [];
$result = $conn->query("SELECT * FROM photos WHERE featured=1");
while ($row = $result->fetch_assoc()) {
    $photos[] = $row;
}
echo json_encode($photos);
?>
