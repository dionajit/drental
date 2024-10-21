<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] != 'dionajit') {
    header("Location: login.php");
    exit();
}

include('db.php');

$bike_id = $_POST['bike_id'];

// Remove bike from the database
$stmt = $conn->prepare("DELETE FROM bikes WHERE bike_id = ?");
$stmt->bind_param("i", $bike_id);
$stmt->execute();

header("Location: owner_dashboard.php");
exit();
?>
