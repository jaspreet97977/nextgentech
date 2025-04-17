<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username already exists in the users collection
    $existingUser = $usersCollection->findOne(['username' => $username]);
    
    if ($existingUser) {
        echo "<script>alert('Username already exists!'); window.location.href='register.php';</script>";
        exit;
    }

    // Hash the password before storing
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user into the users collection
    $usersCollection->insertOne([
        'username' => $username,
        'password' => $hashedPassword,
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    // Redirect to login page with success message
    echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<h2>Register</h2>

<form method="POST" style="max-width: 400px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
    <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
    <button type="submit" style="width: 100%; padding: 10px; background-color: #007bff; border: none; border-radius: 4px; color: white; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
        Register
    </button>
</form>

<p style="text-align: center; margin-top: 10px;">
    Already have an account? <a href="login.php" style="color: #007bff; text-decoration: none;">Login here</a>
</p>

<?php include 'includes/footer.php'; ?>

</body>
</html>
