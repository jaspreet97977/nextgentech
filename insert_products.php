<?php
require 'includes/db.php';

$collection->insertMany([
    [
        'name' => 'Wireless Mouse',
        'price' => 25.99,
        'category' => 'Accessories',
        'image' => 'public/images/mouse.jpg'
    ],
    [
        'name' => 'Mechanical Keyboard',
        'price' => 79.99,
        'category' => 'Accessories',
        'image' => 'public/images/keyboard.jpg'
    ],
    [
        'name' => 'Gaming Laptop',
        'price' => 1299.99,
        'category' => 'Laptops',
        'image' => 'public/images/laptop.jpg'
    ],
    [
        'name' => '4K Monitor',
        'price' => 349.99,
        'category' => 'Monitors',
        'image' => 'public/images/monitor.jpg'
    ],
    [
        'name' => 'Noise Cancelling Headphones',
        'price' => 199.99,
        'category' => 'Accessories',
        'image' => 'public/images/headphones.jpg'
    ]
]);

echo "Sample products added successfully!";
?>
