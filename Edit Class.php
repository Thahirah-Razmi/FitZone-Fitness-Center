<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the class ID is set in the URL
if (isset($_GET['id'])) {
    $class_id = $_GET['id'];

    // Fetch the class's current details
    $sql = "SELECT * FROM classes WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $class = $result->fetch_assoc();
    } else {
        echo "Class not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Update class details on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class_name = $_POST['class_name'];
    $class_type = $_POST['class_type'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $description = $_POST['description'];
    $trainer_id = $_POST['trainer_id'];

    $sql = "UPDATE classes SET class_name=?, class_type=?, start_time=?, end_time=?, description=?, trainer_id=? WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $class_name, $class_type, $start_time, $end_time, $description, $trainer_id, $class_id);

    if ($stmt->execute()) {
        header("Location: Class Management.php?message=Class updated successfully.");
        exit;
    } else {
        echo "Error updating class: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone Fitness Center</title>
    <link rel="stylesheet" href="Style.css">
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
        <h1>Edit Class</h1>

        <form method="post">
            <input type="hidden" name="class_id" value="<?php echo $class['class_id']; ?>">
            <label for="class_name">Class Name:</label>
            <input type="text" id="class_name" name="class_name" value="<?php echo $class['class_name']; ?>" required>

            <label for="class_type">Class Type:</label>
            <input type="text" id="class_type" name="class_type" value="<?php echo $class['class_type']; ?>" required>

            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" value="<?php echo $class['start_time']; ?>" required>

            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time" value="<?php echo $class['end_time']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $class['description']; ?></textarea>

            <label for="trainer_id">Trainer:</label>
            <select id="trainer_id" name="trainer_id" required>
                <?php
                // Fetch trainers for the dropdown
                $trainers_sql = "SELECT trainer_id, trainer_name FROM trainers";
                $trainers_result = $conn->query($trainers_sql);
                while ($trainer = $trainers_result->fetch_assoc()) {
                    $selected = ($trainer['trainer_id'] == $class['trainer_id']) ? 'selected' : '';
                    echo "<option value='{$trainer['trainer_id']}' $selected>{$trainer['trainer_name']}</option>";
                }
                ?>
            </select>

            <button type="submit">Update Class</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>