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
        <h1>Add New Appointment</h1>

        <form action="Add Appointment.php" method="POST">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" required>

            <label for="class_id">Class ID:</label>
            <input type="number" name="class_id" required>

            <label for="appointment_date">Date:</label>
            <input type="date" name="appointment_date" required>

            <label for="appointment_time">Time:</label>
            <input type="time" name="appointment_time" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="Pending">Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="Cancelled">Cancelled</option>
            </select>

            <button type="submit">Add Appointment</button>
        </form>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_POST['user_id'];
            $class_id = $_POST['class_id'];
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
            $status = $_POST['status'];

            // Fetch the username for the given user_id
            $username_sql = "SELECT full_name FROM users WHERE user_id = ?";
            $username_stmt = $conn->prepare($username_sql);
            $username_stmt->bind_param("i", $user_id);
            $username_stmt->execute();
            $username_stmt->bind_result($username);
            $username_stmt->fetch();
            $username_stmt->close();

            // Insert appointment into the database
            $sql = "INSERT INTO appointments (user_id, username, class_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isisss", $user_id, $username, $class_id, $appointment_date, $appointment_time, $status);

            if ($stmt->execute()) {
                echo "<p>Appointment added successfully!</p>";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $conn->close();
        ?>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>