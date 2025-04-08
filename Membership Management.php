<?php
session_start();
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch membership plans from the database
$sql = "SELECT membership_id, membership_name, membership_type, description, price, duration, benefits FROM membership";
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
                <li><a href="MembershipManagement.php">Memberships</a></li>
                <li><a href="Appointments.php">Appointments</a></li>
                <li><a href="Queries.php">Customer Queries</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Membership Management</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<p>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Membership ID</th>
                    <th>Membership Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Benefits</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['membership_id']}</td>
                                <td>{$row['membership_name']}</td>
                                <td>{$row['membership_type']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['duration']}</td>
                                <td>{$row['benefits']}</td>
                                <td>
                                <a href='Edit Membership.php?id={$row['membership_id']}' class='btn'>Edit</a>
                                </td>
                                <td>
                                <a href='Delete Membership.php?id={$row['membership_id']}' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this membership?');\">Delete</a>                  
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No memberships found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <div class="button-container">
        <a href="Add Membership.php" class="btnadd">Add New Membership</a>
    </div>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>
