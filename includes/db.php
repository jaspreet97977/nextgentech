<?php
require __DIR__ . '/../vendor/autoload.php';

$client = new MongoDB\Client("mongodb+srv://ramandeepkourconestoga:rdcxhuFqepY9ssxa@cluster0.k9dth.mongodb.net/NextGenTechDb");
$db = $client->NextGenTech;
$collection = $db->products;
$reviewsCollection = $db->reviews;
$usersCollection = $db->users;
?>
