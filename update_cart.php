<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['quantity'])) {
    $productId = $_POST['id'];
    $quantity = max(1, intval($_POST['quantity'])); // Ensure minimum quantity is 1

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

echo "<script>window.location.href='cart.php';</script>";
?>
