<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user's current details
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

// Update user details on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];

    // Set membership_type to NULL for non-customers
    $membership_type = $role === 'customer' ? $_POST['membership_type'] : null;

    $sql = "UPDATE users SET username=?, password=?, full_name=?, email=?, phone_number=?, role=?, membership_type=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $username, $password, $full_name, $email, $phone_number, $role, $membership_type, $user_id);

    if ($stmt->execute()) {
        echo "User updated successfully. <a href='User Management.php'>Go back</a>";
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
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
        <h1>Edit User</h1>

        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>

            <label for="password">Password:</label>
            <input type="text" id="password" name="password" value="<?php echo $user['password']; ?>" required>

            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $user['phone_number']; ?>" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="staff" <?php if ($user['role'] == 'staff') echo 'selected'; ?>>Staff</option>
                <option value="trainer" <?php if ($user['role'] == 'trainer') echo 'selected'; ?>>Trainer</option>
                <option value="nutrition counselor" <?php if ($user['role'] == 'nutrition counselor') echo 'selected'; ?>>Nutrition Counselor</option>
                <option value="customer" <?php if ($user['role'] == 'customer') echo 'selected'; ?>>Customer</option>
            </select>

            <label for="membership_type">Membership Type:</label>
            <select id="membership_type" name="membership_type" required>
                <option value="Basic Membership - 1 Month" <?php if ($user['membership_type'] == 'Basic Membership - 1 Month') echo 'selected'; ?>>Basic Membership - 1 Month</option>
                <option value="Basic Membership - 6 Months" <?php if ($user['membership_type'] == 'Basic Membership - 6 Months') echo 'selected'; ?>>Basic Membership - 6 Months</option>
                <option value="Basic Membership - 1 Year" <?php if ($user['membership_type'] == 'Basic Membership - 1 Year') echo 'selected'; ?>>Basic Membership - 1 Year</option>
                <option value="Standard Membership - 1 Month" <?php if ($user['membership_type'] == 'Standard Membership - 1 Month') echo 'selected'; ?>>Standard Membership - 1 Month</option>
                <option value="Standard Membership - 6 Months" <?php if ($user['membership_type'] == 'Standard Membership - 6 Months') echo 'selected'; ?>>Standard Membership - 6 Months</option>
                <option value="Standard Membership - 1 Year" <?php if ($user['membership_type'] == 'Standard Membership - 1 Year') echo 'selected'; ?>>Standard Membership - 1 Year</option>
                <option value="Premium Membership - 1 Month" <?php if ($user['membership_type'] == 'Premium Membership - 1 Month') echo 'selected'; ?>>Premium Membership - 1 Month</option>
                <option value="Premium Membership - 6 Months" <?php if ($user['membership_type'] == 'Premium Membership - 6 Months') echo 'selected'; ?>>Premium Membership - 6 Months</option>
                <option value="Premium Membership - 1 Year" <?php if ($user['membership_type'] == 'Premium Membership - 1 Year') echo 'selected'; ?>>Premium Membership - 1 Year</option>
            </select>

            <button type="submit">Update User</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>