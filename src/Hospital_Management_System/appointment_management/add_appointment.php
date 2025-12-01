<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
include('../db.php');

// Initialize error/success messages
$message = "";

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Sanitize and validate input
    $patient_id = isset($_POST['patient_id']) ? intval($_POST['patient_id']) : 0;
    $doctor_id = isset($_POST['doctor_id']) ? intval($_POST['doctor_id']) : 0;
    $appointment_date = isset($_POST['appointment_date']) ? $_POST['appointment_date'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($patient_id && $doctor_id && $appointment_date && $status) {
        // Use prepared statement
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $status);

        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Appointment added successfully!</p>";
        } else {
            $message = "<p style='color: red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        $message = "<p style='color: red;'>Please fill all fields correctly.</p>";
    }
}

// Fetch patients and doctors for dropdowns
$patient_result = mysqli_query($conn, "SELECT * FROM patients");
$doctor_result = mysqli_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Hospital Management System</h1>
    </header>

    <div class="container">
        <h2>Add Appointment</h2>
        <?php echo $message; ?>
        <form action="" method="POST">
            <label for="patient_id">Select Patient:</label><br>
            <select name="patient_id" id="patient_id" required>
                <option value="">Select a Patient</option>
                <?php while ($row = mysqli_fetch_assoc($patient_result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                <?php } ?>
            </select><br><br>

            <label for="doctor_id">Select Doctor:</label><br>
            <select name="doctor_id" id="doctor_id" required>
                <option value="">Select a Doctor</option>
                <?php while ($row = mysqli_fetch_assoc($doctor_result)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                <?php } ?>
            </select><br><br>

            <label for="appointment_date">Appointment Date:</label><br>
            <input type="date" id="appointment_date" name="appointment_date" required><br><br>

            <label for="status">Appointment Status:</label><br>
            <select name="status" id="status" required>
                <option value="Scheduled">Scheduled</option>
                <option value="Completed">Completed</option>
                <option value="Cancelled">Cancelled</option>
            </select><br><br>

            <button type="submit" name="submit" class="submit-btn">Add Appointment</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Hospital Management System</p>
    </footer>
</body>
</html>