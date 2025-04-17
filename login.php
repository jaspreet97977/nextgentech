<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Find user by username in the users collection
    $user = $usersCollection->findOne(['username' => $username]);

    if ($user && password_verify($password, $user['password'])) {
        // Store username in session variable
        $_SESSION['username'] = $username;
        echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
    } else {
        // Display error if username or password is incorrect
        echo "<script>alert('Invalid username or password!'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<h2>Login</h2>

<form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
    <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
    <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; border: none; border-radius: 4px; color: white; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
        Login
    </button>
</form>

<p style="text-align: center; margin-top: 10px;">
    Don't have an account? <a href="registration.php" style="color: #007bff; text-decoration: none;">Register here</a>
</p>
<p style="text-align: center; margin-top: 10px;">
    <a href="forgot_password.php" style="color: #007bff; text-decoration: none;">Forgot Password?</a>
</p>



<?php include 'includes/footer.php'; ?>

</body>
</html>
