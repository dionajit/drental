<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Delete the user profile
    $sql = "DELETE FROM users WHERE username = '$username'";
    if ($conn->query($sql)) {
        session_destroy();
        header("Location: homepage.php");
        exit();
    } else {
        echo "Error deleting profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Profile</title>
</head>
<link rel="stylesheet" href="delete_profile.css">
<body>

<h2>Are you sure you want to delete your profile?</h2>
<form method="post" action="delete_profile.php">
    <input type="submit" value="Delete Profile">
</form>

</body>
</html>

