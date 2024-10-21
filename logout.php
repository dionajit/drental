<?php
session_start();
session_destroy(); // Destroy the session
header('Location: homepage.php'); // Redirect to homepage
exit();
?>
