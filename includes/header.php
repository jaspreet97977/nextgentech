<?php
session_start();
?>

<header>
    <div class="logo">
        <img src="public/images/logo.png" alt="NextGenTech Logo">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="admin_panel.php">Admin Panel</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>

            <li><a href="cart.php">🛒 Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></li>
        </ul>
    </nav>
</header>
