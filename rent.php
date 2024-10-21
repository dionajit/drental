<?php
// Start the session
session_start();

// Connect to the database
include('db.php');

// Check if the bike_id is set in the URL
if (isset($_GET['bike_id'])) {
    $bike_id = $_GET['bike_id'];

    // Fetch bike details from the database
    $bike_query = $conn->prepare("SELECT * FROM bikes WHERE bike_id = ?");
    $bike_query->bind_param("i", $bike_id);
    $bike_query->execute();
    $bike_result = $bike_query->get_result();
    $bike = $bike_result->fetch_assoc();
} else {
    echo "Bike not found.";
    exit;
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming the user is logged in and the session holds their username
    $username = $_SESSION['username'];

    // Fetch the user_id from the database using the username
    $user_query = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $user_query->bind_param("s", $username);
    $user_query->execute();
    $user_result = $user_query->get_result();
    $user = $user_result->fetch_assoc();
    $user_id = $user['id'];

    // If user_id is found, proceed with booking
    if ($user_id) {
        $rent_start = $_POST['rent_start'];
        $rent_end = $_POST['rent_end'];

        // Date validation
        $current_date = date('Y-m-d');
        $max_rent_end_date = date('Y-m-d', strtotime('+1 month'));

        if ($rent_start >= $current_date && $rent_end > $rent_start && $rent_end <= $max_rent_end_date) {
            // Insert booking details into the database
            $booking_query = $conn->prepare("INSERT INTO bookings (user_id, bike_id, rent_start, rent_end) VALUES (?, ?, ?, ?)");
            $booking_query->bind_param("iiss", $user_id, $bike_id, $rent_start, $rent_end);

            if ($booking_query->execute()) {
                echo "<script>
                        alert('Booking successful!');
                        window.location.href = 'loginhomepage.php';
                      </script>";
            } else {
                echo "Error: " . $booking_query->error;
            }
        } else {
            $error = "Please select valid dates. The start date must be today or later, and the end date must be after the start date and within one month.";
        }
    } else {
        echo "User not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent a Bike - Bike Rental</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="rent.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <a href="homepage.php"><img src="logo.png" alt="Bike Rental Logo"></a>
        </div>
        <ul>
            <li><a href="loginhomepage.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <a href="logout.php" class="login-btn">Logout</a>
    </nav>

    <!-- Bike Details Section -->
    <section class="bike-details">
        <!-- Bike Image -->
        <div class="bike-card">
            <img src="uploads/<?php echo $bike['bike_image']; ?>" alt="<?php echo $bike['bike_name']; ?>">
        </div>

        <!-- Bike Information -->
        <div class="bike-info">
            <h3><?php echo $bike['bike_name']; ?></h3>
            <p>Rent: ₹<?php echo $bike['bike_rent']; ?> per day</p>

            <!-- Display error message if date validation fails -->
            <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>

            <!-- Booking Form -->
            <form class="rent-form" method="POST">
                <label for="rent_start">Rent Start Date:</label>
                <input type="date" name="rent_start" id="rent_start" min="<?php echo date('Y-m-d'); ?>" required>

                <label for="rent_end">Rent End Date:</label>
                <input type="date" name="rent_end" id="rent_end" min="<?php echo date('Y-m-d'); ?>" required>

                <button type="submit">Book Now</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Bike Rental. All rights reserved.</p>
    </footer>

</body>
</html>
