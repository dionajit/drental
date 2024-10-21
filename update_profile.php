<?php
include('db.php');
session_start();

// Fetch current user details based on session username
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user details from the database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $name = $user['name'];
        $age = $user['age'];
        $address = $user['address'];
        $gender = $user['gender'];
    } else {
        echo "Error fetching user details!";
        exit();
    }
} else {
    header("location: login.php");
    exit();
}

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int)$_POST['age'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Validate password if user wants to change it
    if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {
        if ($new_password !== $confirm_password) {
            $error_message = "New passwords do not match!";
        } else {
            // Fetch current password from the database
            $sql = "SELECT password FROM users WHERE username = '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($current_password, $user['password'])) {
                    // Hash new password and update it
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET password='$hashed_password' WHERE username='$username'";
                    if ($conn->query($sql) === TRUE) {
                        $success_message = "Password updated successfully!";
                    } else {
                        $error_message = "Error updating password!";
                    }
                } else {
                    $error_message = "Current password is incorrect!";
                }
            }
        }
    }

    // Update user details
    if (empty($error_message)) {
        $sql = "UPDATE users SET name='$name', age=$age, address='$address', gender='$gender' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Profile updated successfully!";
        } else {
            $error_message = "Error updating profile!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="update_profile.css">
</head>
<body>

    <h2>Update Profile</h2>
    <?php if ($error_message) : ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php elseif ($success_message) : ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <form method="post" action="update_profile.php">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $age; ?>" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
            <option value="Other" <?php echo ($gender == 'Other') ? 'selected' : ''; ?>>Other</option>
        </select>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password">

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password">

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">

        <input type="submit" value="Update Profile">
    </form>
    <div class="go-back">
        <p><a href="loginhomepage.php">Go back to Homepage</a></p>
    </div>

</body>
</html>
