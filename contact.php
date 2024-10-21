<?php
session_start();

if (isset($_SESSION['username'])) {
    $homepage = "loginhomepage.php"; 
} else {
    $homepage = "homepage.php"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bike Rental</title>
   <link rel="stylesheet" href="contact.css">
    <script>
        function showAlert() {
            alert("Your message has been sent!");
        }
    </script>
</head>
<body>

    <nav>
        <div class="logo">
            <a href="homepage.php"><img src="logo.png" alt="Bike Rental Logo"></a>
        </div>
        <ul>
            <li><a href="<?php echo $homepage; ?>">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php" class="active">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay">
            <div>
                <h1>Contact Us</h1>
                <p>We are here to help you with any queries or assistance. Get in touch with us!</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact-section">
        <h2>Get In Touch</h2>
        <p>Whether you're curious about our bikes, have a specific question, or just want to say hi, feel free to reach out. We're here to assist you 24/7!</p>

        <!-- Contact Form -->
        <form class="contact-form"  method="POST" onsubmit="showAlert();">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Bike Rental. All rights reserved.</p>
    </footer>

</body>
</html>
