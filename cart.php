<?php
require 'includes/db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
// Initialize cart session if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fetch products from session cart
$cartItems = [];
$totalAmount = 0;

if (!empty($_SESSION['cart'])) {
    $productIds = array_keys($_SESSION['cart']);
    $productObjects = array_map(fn($id) => new MongoDB\BSON\ObjectId($id), $productIds);
    
    $cursor = $collection->find(['_id' => ['$in' => $productObjects]]);
    
    foreach ($cursor as $product) {
        $productId = (string) $product['_id'];
        $quantity = $_SESSION['cart'][$productId];
        $subtotal = $product['price'] * $quantity;
        $totalAmount += $subtotal;

        $cartItems[] = [
            'id' => $productId,
            'name' => $product['name'],
            'image' => $product['image'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'subtotal' => $subtotal
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="cart-container">
    <h2>Your Shopping Cart</h2>
    <?php if (empty($cartItems)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" width="50"></td>
                    <td><?php echo $item['name']; ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>
                        <form method="POST" action="update_cart.php">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                    <td>$<?php echo number_format($item['subtotal'], 2); ?></td>
                    <td>
                        <a href="remove_cart.php?id=<?php echo $item['id']; ?>" class="remove-btn">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Total: $<?php echo number_format($totalAmount, 2); ?></h3>

        <br>
        <a href="index.php" class="continue-shopping">Continue Shopping</a>
        <a href="checkout.php" class="checkout-btn">Go to Checkout</a>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
