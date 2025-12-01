<?php
// Include the database connection file
include('../db.php');

// Fetch the doctors from the database
$query = "SELECT * FROM patients";
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

<h2>View Patients</h2>

<table border="1">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>age</th>
        <th>gender</th>   
        <th>contact</th>
        <th>address</th>
        <th>disease</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><?php echo $row['disease']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
