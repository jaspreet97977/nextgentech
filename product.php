<?php
require 'includes/db.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid product ID!'); window.location.href='index.php';</script>";
    exit;
}

$productId = new MongoDB\BSON\ObjectId($_GET['id']);
$product = $collection->findOne(['_id' => $productId]);

if (!$product) {
    echo "<script>alert('Product not found!'); window.location.href='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $product['name']; ?> - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="product-detail-container">
    <div class="product-image">
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    </div>
    <div class="product-info">
        <h2><?php echo $product['name']; ?></h2>
        <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
        <p><?php echo $product['description']; ?></p>
        <h3>Price: $<?php echo number_format($product['price'], 2); ?></h3>
        <a href="add_to_cart.php?id=<?php echo $product['_id']; ?>" class="add-to-cart">Add to Cart</a>

        <a href="index.php" class="back-btn">← Back to Home</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
