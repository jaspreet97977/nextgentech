<?php
session_start();
require 'includes/db.php';
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$searchQuery = [];
if (isset($_GET['category']) && $_GET['category'] !== "") {
    $searchQuery = ['category' => $_GET['category']];
}

$products = $collection->find($searchQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NextGenTech - Home</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="banner">
    <h2 style="color:#fff;">Welcome to NextGenTech - Your Ultimate Tech Store</h2>
    <p>Find the latest and greatest in technology, from laptops to accessories!</p>
</div>

<div class="container">
    <form method="GET" class="search-filter">
        <label for="category">Filter by Category:</label>
        <select name="category">
            <option value="">All</option>
            <?php
    $categories = $collection->distinct('category');
    foreach ($categories as $category) {
        echo "<option value='$category'>" . ucfirst($category) . "</option>";
    }
    ?>
        </select>
        <button type="submit">Search</button>
    </form>

    <h3>Featured Products</h3>
    <section class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <a href="product.php?id=<?php echo $product['_id']; ?>">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </a>
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
            <a href="add_to_cart.php?id=<?php echo $product['_id']; ?>" class="add-to-cart">Add to Cart</a>
        </div>
    <?php endforeach; ?>
</section>

<p><a href="review.php" class="btn-link-review">Leave a Review for a Product</a></p>

    <section class="about">
        <h2>Why Choose NextGenTech?</h2>
        <p>We provide the best tech products at unbeatable prices. Our collection includes the latest gadgets, accessories, and much more.</p>
        <ul>
            <li>✅ High-quality tech products</li>
            <li>✅ Fast and reliable shipping</li>
            <li>✅ 24/7 customer support</li>
        </ul>
    </section>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
