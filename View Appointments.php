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
                <li><a href="Staff Dashboard.html">Dashboard</a></li>
                <li><a href="View Appointments.php">View Appointments</a></li>
                <li><a href="Queries.php">Respond to Queries</a></li>
                <li><a href="Trainer Management.php">Trainers</a></li>
                <li><a href="Membership Management.php">Memberships</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>View Appointments</h1>

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
                    SELECT a.appointment_id, u.full_name AS user_name, c.class_name AS class_name, 
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
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No appointments found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>