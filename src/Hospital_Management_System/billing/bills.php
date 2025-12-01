<?php
include('../db.php');

// Initialize messages
$message = "";

// Add a new bill
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $patient_name = $_POST['patient_name'];
    $total_amount = $_POST['total_amount'];
    $date = $_POST['date'];

    $query = "INSERT INTO bills (patient_name, total_amount, date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sds", $patient_name, $total_amount, $date);

    if ($stmt->execute()) {
        $message = "<p style='color:green;'>Bill added successfully!</p>";
    } else {
        $message = "<p style='color:red;'>Error adding bill: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Edit existing bill
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $bill_id = $_POST['bill_id'];
    $patient_name = $_POST['patient_name'];
    $total_amount = $_POST['total_amount'];
    $date = $_POST['date'];

    $query = "UPDATE bills SET patient_name = ?, total_amount = ?, date = ? WHERE bill_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdsi", $patient_name, $total_amount, $date, $bill_id);

    if ($stmt->execute()) {
        $message = "<p style='color:green;'>Bill updated successfully!</p>";
    } else {
        $message = "<p style='color:red;'>Error updating bill: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch all bills
$result = mysqli_query($conn, "SELECT * FROM bills");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bills</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
    <h1>Hospital Management System</h1>
</header>

<div class="container">
    <h2>Manage Bills</h2>
    <?php echo $message; ?>

    <div class="form-container">
        <form action="" method="POST">
            <h3>Add/Edit Bill</h3>

            <label for="bill_id">Bill ID (For Editing):</label>
            <input type="text" id="bill_id" name="bill_id" placeholder="Leave blank to add a new bill"><br>

            <label for="patient_name">Patient Name:</label>
            <input type="text" id="patient_name" name="patient_name" required><br>

            <label for="total_amount">Total Amount:</label>
            <input type="number" step="0.01" id="total_amount" name="total_amount" required><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <button type="submit" name="action" value="add" class="submit-btn">Add Bill</button>
            <button type="submit" name="action" value="edit" class="submit-btn">Edit Bill</button>
        </form>
    </div>

    <div class="card-container">
        <h3>Existing Bills</h3>
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <h4>Bill ID: <?php echo $row['bill_id']; ?></h4>
                    <p><strong>Patient Name:</strong> <?php echo htmlspecialchars($row['patient_name']); ?></p>
                    <p><strong>Total Amount:</strong> $<?php echo number_format($row['total_amount'], 2); ?></p>
                    <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
                </div>
                <?php
            }
        } else {
            echo "<p>No bills found.</p>";
        }
        ?>
    </div>
</div>

<footer>
    <p>&copy; 2025 Hospital Management System</p>
</footer>
</body>
</html>