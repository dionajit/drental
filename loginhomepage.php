<?php

include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$user_result = $conn->query("SELECT * FROM users WHERE username = '$username'");
$user = $user_result->fetch_assoc();

$bike_result = $conn->query("SELECT * FROM bikes WHERE available = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Rental - User Homepage</title>
    <link rel="stylesheet" href="loginhomepage.css">
    
</head>
<body>

    <nav>
        <div class="logo">
            <a href="loginhomepage.php"><img src="logo.png" alt="Bike Rental Logo"></a>
        </div>
        <ul>
            <li><a href="loginhomepage.php" class="active">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>

        <div class="user-menu">
        <button><?php echo $user['name']; ?> ▼</button>
        <div class="user-menu-content">
             <a href="update_profile.php">Update Profile</a>
             <a href="bookings.php">My Bookings</a> 
             <a href="delete_profile.php">Delete Profile</a>
            <a href="logout.php">Logout</a>
        </div>
</div>
    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <div>
            <h1>Welcome back, <?php echo $user['name']; ?>!</h1>
            <p>Rent bikes & scooters for hourly, daily, weekly, and monthly rentals.</p>
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
                    <a href="rent.php?bike_id=<?php echo $bike['bike_id']; ?>" class="rent-btn">Rent Now</a>

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
