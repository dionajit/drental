<?php
// Connect to the database
include('db.php');

// Fetch available bikes from the database
$bike_result = $conn->query("SELECT * FROM bikes WHERE available = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Rental - Homepage</title>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    color: #333;
    background-color: #f9f9f9;
}
    

/* Navigation Bar */
nav {
    background-color: #fff;
    padding: 15px 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position:sticky;
    top:0;
}

nav ul {
    list-style-type: none;
    display: flex;
}

nav ul li {
    margin: 0 20px;
    position: relative;
}

nav ul li a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    padding: 10px;
}
nav ul li a.active{
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
}

nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
}

nav .login-btn {
    background-color: #007bff;
    color: #fff;
    padding: 8px 20px;
    border-radius: 5px;
    text-decoration: none;
}

nav .login-btn:hover {
    background-color: #0056b3;
}

/* Logo styling */
.logo img {
    width: 100px;
}

/* Hero Section */
.hero {
    height: 500px;
    background-image: url('https://wallpapers.com/images/featured/4k-bike-p5ztqfie3vnj5kkp.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-align: center;
}

.hero h1 {
    font-size: 3rem;
    font-weight: bold;
}

.hero p {
    font-size: 1.3rem;
    margin-top: 15px;
}

.hero .cta-btn {
    margin-top: 25px;
    padding: 12px 25px;
    background-color: #f36f21;
    color: #fff;
    text-decoration: none;
    font-size: 1.2rem;
    border-radius: 5px;
}

.hero .cta-btn:hover {
    background-color: #e25902;
}

/* Bikes Section */
.bikes-section {
    padding: 50px 20px;
    text-align: center;
    background-color: #f9f9f9;
}

.bikes-section h2 {
    font-size: 2.5rem;
    color: #007bff;
    margin-bottom: 30px;
}

.bikes-grid {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.bike-card {
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 300px;
    margin-bottom: 30px;
}

.bike-card img {
    width: 100%;
    height: 200px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    object-fit: cover;
}

.bike-card h3 {
    font-size: 1.8rem;
    padding: 15px;
    color: #333;
}

.bike-card p {
    padding: 0 15px 20px 15px;
    color: #555;
}

.rent-btn {
    display: inline-block;
    padding: 10px 20px;
    margin-bottom: 15px;
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
}

.rent-btn:hover {
    background-color: #218838;
}

/* Footer */
footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

footer p {
    margin: 0;
}
</style>

</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <a href="homepage.php"><img src="logo.png" alt="Bike Rental Logo"></a>
        </div>
        <ul>
            <li><a href="homepage.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <a href="login.php" class="login-btn">Login/SignUp</a>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Rent Uber-Maintained Bikes for a Hassle-Free Ride</h1>
            <p>Find bikes & scooters for hourly, daily, weekly, and monthly rentals.</p>
        </div>
    </div>

    <!-- Bikes Section -->
    <section class="bikes-section">
        <h2>Available Bikes</h2>
        <div class="bikes-grid">
            <?php while ($bike = $bike_result->fetch_assoc()): ?>
                <div class="bike-card">
                    <img src="uploads/<?php echo $bike['bike_image']; ?>" alt="<?php echo $bike['bike_name']; ?>">
                    <h3><?php echo $bike['bike_name']; ?></h3>
                    <p>Rent: ₹<?php echo $bike['bike_rent']; ?> per day</p>
                    <a href="login.php" class="rent-btn">Rent Now</a>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Bike Rental. All rights reserved.</p>
    </footer>

</body>
</html>
