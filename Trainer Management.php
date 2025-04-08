<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center'); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch classes
$sql = "SELECT * FROM trainers";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone Fitness Center</title>
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="Dashboard.css">
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

    <h1>Trainer Management</h1>

    <?php if (isset($_GET['message'])): ?>
        <p><?php echo $_GET['message']; ?></p>
    <?php endif; ?>

    <h2>Existing Trainers</h2>
    <table>
        <thead>
            <tr>
                <th>Trainer ID</th>
                <th>Trainer Name</th>
                <th>Specialty</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                                <td>{$row['trainer_id']}</td>
                                <td>{$row['trainer_name']}</td>
                                <td>{$row['specialty']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone_number']}</td>
                                <td>
                                    <a href='Edit Trainer.php?id={$row['trainer_id']}' class='btn'>Edit</a>
                                    <a href='Delete Trainer.php?delete_id={$row['trainer_id']}' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this trainer?');\">Delete</a>
                                </td>
                              </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No trainers found</td></tr>";
            } ?>
        </tbody>
    </table>
    </main>

    <div class="button-container">
        <a href="Add Trainer.php" class="btnadd">Add New Trainer</a>
    </div>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>