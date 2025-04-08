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
    <div class="container">
        <!-- Header Section -->
        <header>
            <div class="logo">
                <a href="Home.html"><img src="FitZone Fitness Center Logo.png" alt="FitZone Logo" width="100"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="Customer Dashboard.html">Dashboard</a></li>
                    <li><a href="My Profile.php">My Profile</a></li>
                    <li><a href="Classes.html">Classes</a></li>
                    <li><a href="My Appointments.php">My Appointments</a></li>
                    <li><a href="Contact Us.html">Contact Us</a></li>
                    <li><a href="Logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <h1>My Appointments</h1>

            <?php
            // Start the session
            session_start();

            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fitzone_fitness_center";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get username from session
            if (!isset($_SESSION['username'])) {
                echo "<p>Error: No user logged in.</p>";
                exit;
            }
            $username = $_SESSION['username'];

            // Prepare SQL query to fetch user ID based on username
            $sql_user = "SELECT user_id, full_name FROM users WHERE username = ?";
            $stmt_user = $conn->prepare($sql_user);
            if (!$stmt_user) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt_user->bind_param("s", $username); 
            $stmt_user->execute();
            $stmt_user->bind_result($user_id, $full_name);
            $stmt_user->fetch();
            $stmt_user->close();

            // Check if user details were retrieved
            if (!$user_id) {
                echo "<p>Error: User not found.</p>";
                exit;
            }

            // Prepare SQL query to fetch appointments
            $sql_appointments = "
                SELECT 
                    a.appointment_id, 
                    c.class_name AS class_name, 
                    a.appointment_date, 
                    a.appointment_time, 
                    a.status 
                FROM 
                    appointments a 
                JOIN 
                    classes c ON a.class_id = c.class_id 
                WHERE 
                    a.user_id = ?
            ";

            // Prepare and execute the appointment query
            $stmt_appointments = $conn->prepare($sql_appointments);
            if (!$stmt_appointments) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt_appointments->bind_param("i", $user_id); 
            $stmt_appointments->execute();
            $result = $stmt_appointments->get_result();

            // Check if the user has any appointments
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Appointment ID</th><th>User Name</th><th>Class Name</th><th>Date</th><th>Time</th><th>Status</th></tr>";
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['appointment_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($full_name) . "</td>"; 
                    echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['appointment_time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No appointments found.</p>";
            }

            // Close the statement and connection
            $stmt_appointments->close();
            $conn->close();
            ?>
        </main>

        <!-- Footer Section -->
        <footer>
            <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
        </footer>
</body>

</html>
