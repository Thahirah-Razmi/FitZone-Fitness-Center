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

    <main>
        <h1>Appointments Management</h1>

        <?php
        // Start session to display feedback messages
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<p>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>User Name</th>
                    <th>Class Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch appointments from the database
                $sql = "
                    SELECT a.appointment_id, u.username AS user_name, c.class_name AS class_name, 
                           a.appointment_date, a.appointment_time, a.status 
                    FROM appointments a
                    JOIN users u ON a.user_id = u.user_id
                    JOIN classes c ON a.class_id = c.class_id
                ";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['appointment_id']}</td>
                                <td>{$row['user_name']}</td>
                                <td>{$row['class_name']}</td>
                                <td>{$row['appointment_date']}</td>
                                <td>{$row['appointment_time']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <a href='Edit Appointment.php?id={$row['appointment_id']}' class='btn'>Edit</a>
                                    <a href='Delete Appointment.php?id={$row['appointment_id']}' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this appointment?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No appointments found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="button-container">
            <a href="Add Appointment.php" class="btnadd">Add New Appointment</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>