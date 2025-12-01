<?php
// Include the database connection file
include('../db.php');

// Fetch the doctors from the database
$query = "SELECT * FROM appointments";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
</head>
<body>

<h2>View Appointments</h2>

<table border="1">
    <tr>
        <th>appointment id</th>
        <th> patient id</th>
        <th>doctor id</th>
        <th>appointment date</th>   
        <th>status</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['patient_id']; ?></td>
        <td><?php echo $row['doctor_id']; ?></td>
        <td><?php echo $row['appointment_date']; ?></td>
        <td><?php echo $row['status']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
