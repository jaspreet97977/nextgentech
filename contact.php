<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us - NextGenTech</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="contact-container">
    <h2>Contact Us</h2>
    <p>Have any questions? Get in touch with us!</p>

    <div class="contact-content">
        <div class="contact-form">
            <h3>Send us a Message</h3>
            <form action="send_message.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>

        <div class="contact-info">
            <h3>Our Contact Details</h3>
            <p><strong>Address:</strong> 50 wellington</p>
            <p><strong>Phone:</strong> +1 (555) 123-4567</p>
            <p><strong>Email:</strong> support@nextgentech.com</p>
            <p><strong>Working Hours:</strong> Mon-Fri: 9 AM - 6 PM</p>
        </div>
    </div>

    <div class="map-container">
        <h3>Our Location</h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5822.492027890122!2d-80.2737968302246!3d43.141363000000034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882c6608c9630f43%3A0x6ff1f7bf37ed092!2sConestoga%20College%20-%20Brantford!5e0!3m2!1sen!2sca!4v1741229238496!5m2!1sen!2sca" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
