<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center'); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for adding a user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, full_name, email, phone_number, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $password, $full_name, $email, $phone_number, $role);

    if ($stmt->execute()) {
        header("Location: User Management.php?message=User added successfully.");
        exit;
    } else {
        echo "Error: " . $stmt->error;
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
        <h1>Add User</h1>

        <form method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="trainer">Trainer</option>
                <option value="nutrition counselor">Nutrition Counselor</option>
                <option value="user">User</option>
            </select>

            <label for="membership_type">Membership Type:</label>
            <select id="membership_type" name="membership_type" required>
                <option value="Basic-1M">Basic Membership - 1 Month</option>
                <option value="Basic-6M">Basic Membership - 6 Months</option>
                <option value="Basic-1Y">Basic Membership - 1 Year</option>
                <option value="Standard-1M">Standard Membership - 1 Month</option>
                <option value="Standard-6M">Standard Membership - 6 Months</option>
                <option value="Standard-1Y">Standard Membership - 1 Year</option>
                <option value="Premium-1M">Premium Membership - 1 Month</option>
                <option value="Premium-6M">Premium Membership - 6 Months</option>
                <option value="Premium-1Y">Premium Membership - 1 Year</option>
            </select>

            <button type="submit">Add User</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>