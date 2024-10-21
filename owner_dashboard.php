<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'dionajit') {
    header("Location: login.php"); // Redirect if not owner
    exit();
}

include('db.php');

// Fetch bike data from the database
$bike_result = $conn->query("SELECT * FROM bikes");

// Fetch stats: total number of users and available bikes
$user_count = $conn->query("SELECT COUNT(*) AS total_users FROM users")->fetch_assoc()['total_users'];
$bike_count = $conn->query("SELECT COUNT(*) AS total_bikes FROM bikes WHERE available = 1")->fetch_assoc()['total_bikes'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="owner_dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Owner Dashboard</h1>

        <div class="stats">
            <p>Total Users: <?php echo $user_count; ?></p>
            <p>Available Bikes: <?php echo $bike_count; ?></p>
        </div>

        <!-- Bike Table -->
        <h2>List of Available Bikes</h2>
        <table>
            <thead>
                <tr>
                    <th>Bike ID</th>
                    <th>Bike Name</th>
                    <th>Bike Rent</th>
                    <th>Available</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $bike_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['bike_id']; ?></td>
                        <td><?php echo $row['bike_name']; ?></td>
                        <td><?php echo $row['bike_rent']; ?></td>
                        <td><?php echo $row['available'] ? 'Yes' : 'No'; ?></td>
                        <td><img src="uploads/<?php echo $row['bike_image']; ?>" width="80"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add Bike Form -->
        <h2>Add a New Bike</h2>
        <form action="add_bike.php" method="POST" enctype="multipart/form-data">
            <label for="bike_name">Bike Name:</label>
            <input type="text" name="bike_name" required>

            <label for="bike_rent">Bike Rent (per day):</label>
            <input type="number" name="bike_rent" required>

            <label for="bike_image">Bike Image:</label>
            <input type="file" name="bike_image" required>

            <input type="submit" value="Add Bike">
        </form>

        <!-- Remove Bike Form -->
        <h2>Remove a Bike</h2>
        <form action="remove_bike.php" method="POST">
            <label for="bike_id">Bike ID:</label>
            <input type="number" name="bike_id" required>

            <input type="submit" value="Remove Bike">
        </form>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
