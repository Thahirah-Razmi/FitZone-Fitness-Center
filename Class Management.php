<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center'); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch classes
$sql = "SELECT c.*, t.trainer_name 
        FROM classes c 
        JOIN trainers t ON c.trainer_id = t.trainer_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone Fitness Center</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="CM_Style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="Home.html"><img src="FitZone Fitness Center Logo.png" alt="FitZone Logo" width="100"></a>
        </div>
        <nav>
            <ul>
                <li><a href="Admin Dashboard.html">Dashboard</a></li>
                <li><a href="User Management.php">User Management</a></li>
                <li><a href="Class Management.php">Classes</a></li>
                <li><a href="Trainer Management.php">Trainers</a></li>
                <li><a href="Membership Management.php">Memberships</a></li>
                <li><a href="Appointments.php">Appointments</a></li>
                <li><a href="Queries.php">Customer Queries</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <h1>Class Management</h1>

    <?php if (isset($_GET['message'])): ?>
        <p><?php echo $_GET['message']; ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>Class Name</th>
            <th>Class Type</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Description</th>
            <th>Trainer ID</th>
            <th>Trainer Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php while ($class = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $class['class_name']; ?></td>
                <td><?php echo $class['class_type']; ?></td>
                <td><?php echo $class['start_time']; ?></td>
                <td><?php echo $class['end_time']; ?></td>
                <td><?php echo $class['description']; ?></td>
                <td><?php echo $class['trainer_id']; ?></td>
                <td><?php echo $class['trainer_name']; ?></td>
                <td>
                    <a href="Edit Class.php?id=<?php echo $class['class_id']; ?>" class='btn'>Edit</a>
                </td>
                <td>
                    <a href="Delete Class.php?id=<?php echo $class['class_id']; ?>" class='btn delete' onclick="return confirm('Are you sure you want to delete this class?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="button-container">
        <a href="Add Class.php" class="btnadd">Add New Class</a>
    </div>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>