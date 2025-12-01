<?php
include('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "<p>Passwords do not match!</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            echo "<p>Sign-up successful! <a href='login.php'>Login here</a></p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Hospital Management System</h1>
    </header>

    <div class="container">
        <h2>Create Account</h2>
        <form method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter your password again" required>
            </div>
            <button type="submit" class="submit-btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <footer>
        <p>&copy; 2025 Hospital Management System</p>
    </footer>
</body>
</html>
