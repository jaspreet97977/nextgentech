<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['reset_username'])) {
    echo "<script>alert('Unauthorized access!'); window.location.href='login.php';</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    $usersCollection->updateOne(
        ['username' => $_SESSION['reset_username']],
        ['$set' => ['password' => $hashedPassword]]
    );

    unset($_SESSION['reset_username']);
    echo "<script>alert('Password reset successful!'); window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<h2>Reset Password</h2>

<form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
    <input type="password" name="new_password" placeholder="Enter new password" required style="width:100%; padding:10px; margin:10px 0;">
    <button type="submit" style="width:100%; padding:10px; background-color:#27ae60; color:#fff; border:none; border-radius:4px;">Reset Password</button>
</form>

<?php include 'includes/footer.php'; ?>

</body>
</html>
