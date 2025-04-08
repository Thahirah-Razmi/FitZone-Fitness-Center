<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center'); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $trainer_id = $_GET['id'];

    // Fetch the trainer's current details
    $sql = "SELECT * FROM trainers WHERE trainer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $trainer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $trainer = $result->fetch_assoc();
    } else {
        echo "Trainer not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Update trainer details on form submission

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainer_name = $_POST['trainer_name'];
    $specialty = $_POST['specialty'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE trainers SET trainer_name=?, specialty=?, email=?, phone_number=? WHERE trainer_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $trainer_name, $specialty, $email, $phone_number, $trainer_id);

    if ($stmt->execute()) {
        header("Location: Trainer Management.php?message=Trainer updated successfully!");
        exit;
    } else {
        echo "Error updating trainer: " . $conn->error;
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
        <h1>Edit Trainer</h1>

        <form method="POST">
            <label for="trainer_name">Trainer Name:</label>
            <input type="text" id="trainer_name" name="trainer_name" value="<?php echo htmlspecialchars($trainer['trainer_name']); ?>" required>

            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" value="<?php echo htmlspecialchars($trainer['specialty']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($trainer['email']); ?>" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($trainer['phone_number']); ?>" required>

            <button type="submit">Update Trainer</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>