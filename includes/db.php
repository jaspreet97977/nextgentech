<?php
require __DIR__ . '/../vendor/autoload.php';

// Directly add your MongoDB URI here (replace with your actual connection string)
$client = new MongoDB\Client("mongodb+srv://ramandeepkourconestoga:rdcxhuFqepY9ssxa@cluster0.k9dth.mongodb.net/NextGenTechDb");

// Access the database
$db = $client->NextGenTech;

// Access the collections
$collection = $db->products;
$reviewsCollection = $db->reviews;
$usersCollection = $db->users;
?>
