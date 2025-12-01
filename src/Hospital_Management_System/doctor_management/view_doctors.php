<?php
// Include the database connection file
include('../db.php');

// Fetch the doctors from the database
$query = "SELECT * FROM doctors";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctors</title>
</head>
<body>

<h2>View Doctors</h2>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Specialization</th>
        <th>Contact</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['specialization']; ?></td>
        <td><?php echo $row['contact']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
