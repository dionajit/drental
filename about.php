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
    <title>About Us - Bike Rental</title>
    <link rel="stylesheet" href="about.css">
    
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <a href="<?php echo $homepage; ?>"><img src="logo.png" alt="Bike Rental Logo"></a>
        </div>
        <ul>
            <li><a href="<?php echo $homepage; ?>">Home</a></li>
            <li><a href="about.php" class="active">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay">
            <div>
                <h1>We Understand Your Bike Rental Needs</h1>
                <p>At D-Rental, we offer top-quality bikes to make your rides enjoyable and affordable. Join us for the best bike rental experience.</p>
            </div>
        </div>
    </div>

    <div class="about-section">
    <h2>About Us</h2>
    <div class="about-content">
        <p><strong>D Rental</strong> was founded by Mr. Dion Ajit in August 2020. We are passionate about travel and adventure, and we want you to experience the joy of exploring new places on two wheels! What started as a simple bike rental platform has evolved into a vibrant ecosystem catering to all biking enthusiasts.</p>
        <p>From city rides to mountain trails, our diverse fleet includes everything from sleek scooters to rugged mountain bikes, ensuring there's the perfect bike for every journey. Whether you're seeking a leisurely ride or an exhilarating adventure, we've got you covered!</p>
        <p>Our mission is simple: to offer an affordable, convenient, and eco-friendly way to explore the world on two wheels. With dedicated customer support and a commitment to sustainability, we strive to make your biking experience seamless and enjoyable. Join us in embracing the freedom of the open road!</p>
    </div>
</div>
<div class="founder-section">
        <img src="photo.png" alt="Dion Ajit" class="founder-image"> <!-- Replace with actual image path -->
        <h3>Mr. Dion Ajit</h3>
        <p>Founder & CEO</p>
    </div>
</div>
    <!-- Features Section -->
    <div class="features">
        <div class="feature-box">
            <h3>Wide Variety</h3>
            <p>Choose from a range of top-quality bikes for every type of rider.</p>
        </div>
        <div class="feature-box">
            <h3>Affordable Pricing</h3>
            <p>Get the best deals on bike rentals, no hidden charges.</p>
        </div>
        <div class="feature-box">
            <h3>Excellent Support</h3>
            <p>Our team is available 24/7 to assist with your bike rental needs.</p>
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Bike Rental. All rights reserved.</p>
    </footer>

</body>
</html>
