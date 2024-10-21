<?php
// Connect to the database
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

$username = $_SESSION['username'];

// Fetch the user_id based on the logged-in username
$user_result = $conn->query("SELECT id FROM users WHERE username = '$username'");
$user = $user_result->fetch_assoc();
$user_id = $user['id'];

// Handle cancel booking
if (isset($_POST['cancel_booking'])) {
    $booking_id = $_POST['booking_id'];
    $conn->query("DELETE FROM bookings WHERE booking_id = '$booking_id' AND user_id = '$user_id'");
    header("Location: bookings.php"); // Refresh page after canceling
    exit();
}

// Fetch booking details for the user
$bookings_result = $conn->query("
    SELECT bookings.booking_id, bikes.bike_name, bikes.bike_rent, bookings.rent_start, bookings.rent_end
    FROM bookings
    JOIN bikes ON bookings.bike_id = bikes.bike_id
    WHERE bookings.user_id = '$user_id'
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="bookings.css">
    <script>
        function confirmCancellation() {
            return confirm("Are you sure you want to cancel this booking?");
        }
    </script>
</head>
<body>

    <h2>My Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Bike Name</th>
                <th>Rent (₹/day)</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $bookings_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['booking_id']; ?></td>
                    <td><?php echo $booking['bike_name']; ?></td>
                    <td><?php echo $booking['bike_rent']; ?></td>
                    <td><?php echo $booking['rent_start']; ?></td>
                    <td><?php echo $booking['rent_end']; ?></td>
                    <td>
                        <form method="post" action="" onsubmit="return confirmCancellation();">
                            <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                            <button type="submit" name="cancel_booking" class="cancel-btn">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="loginhomepage.php" class="back-btn">←Back to Homepage</a>

</body>
</html>