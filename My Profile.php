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
        <h1>My Profile</h1>

        <?php
        // Start session
        session_start();

        // Check if user is logged in
        if (!isset($_SESSION['username'])) {
            echo "<p>Please log in to view your profile.</p>";
            exit;
        }

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
        $username = $_SESSION['username'];

        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists and fetch details
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            echo "<h2>Welcome, " . htmlspecialchars($user['full_name']) . "!</h2>";
            echo "<p><strong>Username:</strong> " . htmlspecialchars($user['username']) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
            echo "<p><strong>Phone Number:</strong> " . htmlspecialchars($user['phone_number']) . "</p>";
            echo "<p><strong>Role:</strong> " . htmlspecialchars($user['role']) . "</p>";
            echo "<p><strong>Membership Type:</strong> " . htmlspecialchars($user['membership_type']) . "</p>";
            echo "<p><strong>Account Created On:</strong> " . htmlspecialchars($user['created_at']) . "</p>";
        } else {
            echo "<p>User not found.</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
        ?>
    </main>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>

</body>

</html>