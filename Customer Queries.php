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
            <h1>My Queries</h1>

            <?php
            // Start the session at the beginning
            session_start();

            // Check if the user is logged in by checking if 'username' is set in the session
            if (!isset($_SESSION['username'])) {
                // Redirect to login page if the user is not logged in
                header("Location: Login.html");
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

            // Get the logged-in username from the session
            $current_username = $_SESSION['username'];

            // Step 1: Retrieve the email based on the username
            $sql_email = "SELECT email FROM users WHERE username = ?";
            $stmt_email = $conn->prepare($sql_email);
            $stmt_email->bind_param("s", $current_username);
            $stmt_email->execute();
            $stmt_email->bind_result($current_email);
            $stmt_email->fetch();
            $stmt_email->close();

            // If no email is found, show an error message
            if (!$current_email) {
                echo "<p>Error: Email not found for the logged-in user.</p>";
                exit;
            }
            // Step 2: Prepare SQL query to join users and contact_messages based on email
            $sql = "
    SELECT 
        u.full_name, 
        u.email, 
        u.phone_number, 
        c.message, 
        c.response, 
        c.status, 
        c.created_at 
    FROM 
        contact_messages c 
    JOIN 
        users u 
    ON 
        c.email = u.email 
    WHERE 
        u.email = ?
";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $current_email);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the user has any queries
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Message</th><th>Response</th><th>Status</th><th>Created At</th></tr>";
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    // Use a ternary operator to handle null values
                    echo "<td>" . htmlspecialchars($row['full_name'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone_number'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['message'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['response'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['status'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at'] ?? '') . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No queries found.</p>";
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
    </div>
</body>

</html>