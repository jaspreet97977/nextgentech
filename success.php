<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Success - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div style="
    max-width: 600px;
    margin: 80px auto;
    padding: 40px;
    background-color: white;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
">
    <h2 style="color: #007bff; font-size: 28px; margin-bottom: 20px;">🎉 Payment Successful!</h2>
    <p style="font-size: 18px; margin-bottom: 30px;">Thank you for your purchase. Your order has been placed successfully.</p>
    <a href="index.php" style="
        display: inline-block;
        padding: 12px 25px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    " onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'">
        Continue Shopping
    </a>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
