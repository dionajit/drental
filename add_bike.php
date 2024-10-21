<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'dionajit') {
    header("Location: login.php");
    exit();
}

include('db.php');

// Handle bike image upload
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["bike_image"]["name"]);
move_uploaded_file($_FILES["bike_image"]["tmp_name"], $target_file);

// Insert new bike into the database
$bike_name = $_POST['bike_name'];
$bike_rent = $_POST['bike_rent'];
$bike_image = basename($_FILES["bike_image"]["name"]);

$stmt = $conn->prepare("INSERT INTO bikes (bike_name, bike_rent, bike_image, available) VALUES (?, ?, ?, 1)");
$stmt->bind_param("sis", $bike_name, $bike_rent, $bike_image);
$stmt->execute();

header("Location: owner_dashboard.php");
exit();
?>
