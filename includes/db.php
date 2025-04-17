<?php
require __DIR__ . '/../vendor/autoload.php';

$client = new MongoDB\Client("var");
$db = $client->NextGenTech;
$collection = $db->products;
$reviewsCollection = $db->reviews;
$usersCollection = $db->users;
?>
