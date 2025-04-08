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
        <h1>Edit Appointment</h1>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the appointment ID is set
        if (isset($_GET['id'])) {
            $appointment_id = $_GET['id'];

            // Fetch appointment details
            $sql = "SELECT * FROM appointments WHERE appointment_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $appointment_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $appointment = $result->fetch_assoc();
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_POST['user_id'];
            $class_id = $_POST['class_id'];
            $appointment_date = $_POST['appointment_date'];
            $appointment_time = $_POST['appointment_time'];
            $status = $_POST['status'];

            // Update appointment in the database
            $sql = "UPDATE appointments SET user_id = ?, class_id = ?, appointment_date = ?, appointment_time = ?, status = ? WHERE appointment_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisssi", $user_id, $class_id, $appointment_date, $appointment_time, $status, $appointment_id);

            if ($stmt->execute()) {
                echo "<p>Appointment updated successfully!</p>";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $conn->close();
        ?>

        <form action="Edit Appointment.php?id=<?php echo $appointment_id; ?>" method="POST">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" value="<?php echo $appointment['user_id']; ?>" required>

            <label for="class_id">Class ID:</label>
            <input type="number" name="class_id" value="<?php echo $appointment['class_id']; ?>" required>

            <label for="appointment_date">Date:</label>
            <input type="date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>

            <label for="appointment_time">Time:</label>
            <input type="time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>" required>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="Pending" <?php echo ($appointment['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Confirmed" <?php echo ($appointment['status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Cancelled" <?php echo ($appointment['status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>

            <button type="submit">Update Appointment</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>