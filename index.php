<?php
// Include database connection if needed for search functionality
include('db.php');

// Search functionality logic
$search_result = "";
if (isset($_POST['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);
    
    // Example: Searching for bikes in the 'bikes' table
    $sql = "SELECT * FROM bikes WHERE bike_name LIKE '%$search_query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_result .= "<div class='search-item'>";
            $search_result .= "<h3>" . $row['bike_name'] . "</h3>";
            $search_result .= "<p>Rent Price: $" . $row['rent_price'] . "</p>";
            $search_result .= "</div>";
        }
    } else {
        $search_result = "<p>No results found for '$search_query'</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Rental - Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <!-- Search Form -->
        <form action="index.php" method="POST">
            <input type="text" name="search_query" placeholder="Search bikes...">
            <input type="submit" name="search" value="Search">
        </form>
    </nav>

    <!-- Main Section -->
    <div class="main-content">
        <!-- Home Section -->
        <section id="home">
            <h1>Welcome to Our Bike Rental Service</h1>
            <p>Rent the best bikes at affordable prices.</p>
        </section>

        <!-- Search Results Section -->
        <?php
        if (isset($_POST['search'])) {
            echo "<h2>Search Results</h2>";
            echo $search_result;
        }
        ?>

        

        <section id="contact">
            <h2>Contact Us</h2>
            <p>Phone: +1234567890</p>
            <p>Email: info@bikerental.com</p>
        </section>
    </div>

</body>
</html>
