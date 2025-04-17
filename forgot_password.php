<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $user = $usersCollection->findOne(['username' => $username]);

    if ($user) {
        $_SESSION['reset_username'] = $username;
        echo "<script>alert('Username found. You can reset your password.'); window.location.href='reset_password.php';</script>";
    } else {
        echo "<script>alert('Username not found!'); window.location.href='forgot_password.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<h2>Forgot Password</h2>

<form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <input type="text" name="username" placeholder="Enter your username" required style="width:100%; padding:10px; margin:10px 0;">
    <button type="submit" style="width:100%; padding:10px; background-color:#007bff; color:#fff; border:none; border-radius:4px;">Submit</button>
</form>

<?php include 'includes/footer.php'; ?>

</body>
</html>
