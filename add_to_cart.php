<?php
session_start();

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid product ID!'); window.location.href='index.php';</script>";
    exit;
}

$productId = $_GET['id'];

// Add product to cart or increase quantity if already exists
if (!isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId] = 1;
} else {
    $_SESSION['cart'][$productId]++;
}

echo "<script>alert('Product added to cart!'); window.location.href='cart.php';</script>";
?>
