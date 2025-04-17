<?php
session_start();

if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    unset($_SESSION['cart'][$productId]);
}

echo "<script>window.location.href='cart.php';</script>";
?>
