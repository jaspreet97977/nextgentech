<?php
session_start();
require 'includes/db.php';

$reviewsCollection = $db->reviews;

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['review']) && !empty($_POST['review'])) {
        // Check if the user is logged in
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $review = [
                'product_id' => $_POST['product_id'],
                'review' => $_POST['review'],
                'username' => $username,
                'date' => new MongoDB\BSON\UTCDateTime(),
            ];

            // Insert review into the database
            $reviewsCollection->insertOne($review);
        } else {
            // Redirect to login page if the user is not logged in
            echo "<script>alert('You must be logged in to submit a review.'); window.location.href='login.php';</script>";
            exit;
        }
    }
}

// Get all products
$products = $collection->find();

// Get reviews for products
$reviews = $reviewsCollection->find();

$reviewsByProductId = [];
foreach ($reviews as $review) {
    $reviewsByProductId[(string)$review['product_id']][] = $review;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Reviews - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
    <h2 style="font-size: 2em; margin-bottom: 20px; text-align: center;">Customer Reviews</h2>
    
    <?php foreach ($products as $product): ?>
        <div class="productr" style="border: 1px solid #ccc; margin-bottom: 20px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <h3 style="font-size: 1.5em; color: #333;"><?php echo $product['name']; ?></h3>
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100%; max-width: 300px; height: auto; display: block; margin: 10px auto;">

            <h4 style="margin-top: 20px; font-size: 1.2em; color: #333;">Leave a Review</h4>
            <!-- Only show review form if the user is logged in -->
            <?php if (isset($_SESSION['username'])): ?>
                <form method="POST" action="review.php" style="margin-top: 10px;">
                    <input type="hidden" name="product_id" value="<?php echo $product['_id']; ?>">
                    <textarea name="review" placeholder="Write your review here..." required style="width: 100%; height: 100px; padding: 10px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ddd;"></textarea>
                    <button type="submit" style="padding: 10px 20px; border: none; background-color: #28a745; color: white; font-size: 1em; border-radius: 4px; cursor: pointer;">Submit Review</button>
                </form>
            <?php else: ?>
                <p style="margin-top: 10px; color: #555;">Please <a href="login.php" style="color: #007bff;">login</a> to leave a review.</p>
            <?php endif; ?>

            <h4 style="margin-top: 30px; font-size: 1.2em; color: #333;">Reviews</h4>
            <?php if (isset($reviewsByProductId[(string)$product['_id']])): ?>
                <ul style="list-style-type: none; padding: 0;">
                    <?php foreach ($reviewsByProductId[(string)$product['_id']] as $review): ?>
                        <li style="margin-bottom: 10px; padding: 10px; background-color: #f8f9fa; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <strong style="color: #007bff;"><?php echo htmlspecialchars($review['username']); ?>:</strong> 
                            <p style="color: #555;"><?php echo htmlspecialchars($review['review']); ?></p>
                            <small style="color: #888;">Posted on: <?php echo $review['date']->toDateTime()->format('Y-m-d H:i'); ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
