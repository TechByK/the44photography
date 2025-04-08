<?php
// get_packages.php: Returns JSON data for photography packages.
// Assume you have a 'packages' table with columns: id, name, price, description
include('includes/db.php');
header('Content-Type: application/json');
$packages = [];
$result = $conn->query("SELECT * FROM packages");
while ($row = $result->fetch_assoc()) {
    $packages[] = $row;
}
echo json_encode($packages);
?>
