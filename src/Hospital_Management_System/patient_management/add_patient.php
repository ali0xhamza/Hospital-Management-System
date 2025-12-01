<?php
 
include('../db.php');
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $disease = mysqli_real_escape_string($conn, $_POST['disease']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
 
    $query = "INSERT INTO patients (name, age, address, disease, contact, gender) 
              VALUES ('$name', '$age', '$address', '$disease', '$contact', '$gender')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Patient added successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
 <header>
        <h1>Hospital Management System</h1>
    </header>
<div class="container">
    <h2>Add Patient</h2>
    <form action="" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="contact">Contact:</label><br>
        <input type="text" id="contact" name="contact" required><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" required></textarea><br><br>

        <label for="disease">Disease:</label><br>
        <input type="text" id="disease" name="disease" required><br><br>

        <button type="submit" class="submit-btn">Add Patient</button>
    </form>
</div>
 <footer>
        <p>&copy; 2025 Hospital Management System</p>
    </footer>
</body>
</html>
