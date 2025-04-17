<?php
require 'includes/db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $created_at = new MongoDB\BSON\UTCDateTime((new DateTime())->getTimestamp() * 1000); // Timestamp

    // Insert into MongoDB
    $contactCollection = $db->contact_messages;
    $insertResult = $contactCollection->insertOne([
        'name' => $name,
        'email' => $email,
        'message' => $message,
        'created_at' => $created_at
    ]);

    if ($insertResult->getInsertedCount() > 0) {
        echo "<script>alert('Your message has been saved successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error saving message. Please try again later.'); window.location.href='contact.php';</script>";
    }
}
?>
