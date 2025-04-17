<?php
require 'vendor/autoload.php';
require 'includes/db.php';
session_start();

\Stripe\Stripe::setApiKey("sk_test_51QzV0dHXLp6P7TWnXxMndgVys5eeUQyNSqid4rTq7sQiYzlsxef2CHpoBZEU0oQcBhgNZyWoBSnJfzYbXR5Y6zS700IkuCt3Bj");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];
    $amount = $_POST['amount'];

    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'NextGenTech Purchase',
            'source' => $token,
        ]);

        // Save order in MongoDB
        $order = [
            'user_id' => session_id(),
            'amount' => $amount / 100,
            'items' => $_SESSION['cart'],
            'payment_status' => 'Paid',
            'created_at' => new MongoDB\BSON\UTCDateTime(),
        ];
        $db->orders->insertOne($order);

        // Clear cart after successful payment
        unset($_SESSION['cart']);

        echo "<script>alert('Payment Successful!'); window.location.href='success.php';</script>";
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Payment Failed: " . $e->getMessage() . "'); window.location.href='checkout.php';</script>";
        exit;
    }
}
?>
