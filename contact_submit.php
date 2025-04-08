<?php
// contact_submit.php: Processes the contact form submissions
include('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $message = $_POST['message'];
    
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    if ($stmt->execute()) {
        echo "Thank you for contacting us!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
