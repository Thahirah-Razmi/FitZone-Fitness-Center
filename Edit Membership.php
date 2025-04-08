<?php
session_start();
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the membership ID is set in the URL
if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];

    // Fetch the membership's current details
    $sql = "SELECT * FROM membership WHERE membership_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $membership_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $membership = $result->fetch_assoc();
    } else {
        echo "Membership not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Update membership details on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $membership_name = $_POST['membership_name'];
    $membership_type = $_POST['membership_type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $benefits = $_POST['benefits'];

    $sql = "UPDATE membership SET membership_name=?, membership_type=?, description=?, price=?, duration=?, benefits=? WHERE membership_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $membership_name, $membership_type, $description, $price, $duration, $benefits, $membership_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Membership updated successfully.";
        header("Location: Membership Management.php");
        exit;
    } else {
        echo "Error updating membership: " . $conn->error;
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
                <li><a href="MembershipManagement.php">Memberships</a></li>
                <li><a href="Appointments.php">Appointments</a></li>
                <li><a href="Queries.php">Customer Queries</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Edit Membership</h1>
        <form method="post">
            <input type="hidden" name="membership_id" value="<?php echo $membership['membership_id']; ?>">
            <label for="membership_name">Membership Name:</label>
            <input type="text" id="membership_name" name="membership_name" value="<?php echo $membership['membership_name']; ?>" required>

            <label for="membership_type">Membership Type:</label>
            <input type="text" id="membership_type" name="membership_type" value="<?php echo $membership['membership_type']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $membership['description']; ?></textarea>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $membership['price']; ?>" required>

            <label for="duration">Duration:</label>
            <input type="text" id="duration" name="duration" value="<?php echo $membership['duration']; ?>" required>

            <label for="benefits">Benefits:</label>
            <textarea id="benefits" name="benefits" required><?php echo $membership['benefits']; ?></textarea>

            <button type="submit">Update Membership</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>