<?php
require 'includes/db.php';
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Your cart is empty!'); window.location.href='cart.php';</script>";
    exit;
}

// Calculate total amount
$totalAmount = 0;
foreach ($_SESSION['cart'] as $productId => $quantity) {
    $product = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($productId)]);
    if ($product) {
        $totalAmount += $product['price'] * $quantity;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="checkout-container">
    <h2>Checkout</h2>
    <p>Total Amount: <strong>$<?php echo number_format($totalAmount, 2); ?></strong></p>

    <form action="charge.php" method="POST" id="payment-form">
        <input type="hidden" name="amount" value="<?php echo $totalAmount * 100; ?>">

        <h3>Billing Information</h3>
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="address">Address:</label>
        <input type="text" name="address" required>

        <label for="city">City:</label>
        <input type="text" name="city" required>

        <label for="state">State:</label>
        <input type="text" name="state" required>

        <label for="zip">Zip Code:</label>
        <input type="text" name="zip" required>

        <label for="country">Country:</label>
        <input type="text" name="country" required>

        <h3>Payment Details</h3>
        <label for="card-element">Credit or Debit Card:</label>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>

        <button type="submit" id="submit-payment">Pay Now</button>
    </form>
</div>

<script>
    var stripe = Stripe("pk_test_51QzV0dHXLp6P7TWnYqyiAgseJg80NwlHqjJnJyJgcw8csPn8lR9XQ5awAfyCNSTlN3o9P77pBBeewZErYBOT5pMO00Zele8ZlA");
    var elements = stripe.elements();
    var card = elements.create("card");
    card.mount("#card-element");

    var form = document.getElementById("payment-form");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                document.getElementById("card-errors").textContent = result.error.message;
            } else {
                var hiddenInput = document.createElement("input");
                hiddenInput.setAttribute("type", "hidden");
                hiddenInput.setAttribute("name", "stripeToken");
                hiddenInput.setAttribute("value", result.token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    });
</script>

<?php include 'includes/footer.php'; ?>

</body>
</html>
