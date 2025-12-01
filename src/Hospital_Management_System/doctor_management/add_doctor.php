<?php
include('../db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];

    $query = "INSERT INTO doctors (name, specialization, contact, email) VALUES ('$name', '$specialty', '$contact', '$email')";
    if (mysqli_query($conn, $query)) {
        echo "<p>Doctor added successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Hospital Management System</h1>
    </header>

    <div class="container">
        <h2>Add Doctor</h2>
        <form method="POST">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="specialty">Specialty:</label>
                <input type="text" id="specialty" name="specialty" required>
            </div>
            <div>
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="submit-btn">Add Doctor</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Hospital Management System</p>
    </footer>
</body>
</html>
