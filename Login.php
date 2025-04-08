<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitZone Fitness Center</title>
    <link rel="stylesheet" href="Style.css">
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <a href="Home.html"><img src="FitZone Fitness Center Logo.png" width="100"></a>
        </div>
        <nav>
            <ul>
                <li><a href="Home.html">Home</a></li>
                <li><a href="About Us.html">About Us</a></li>
                <li><a href="Classes.html">Classes</a></li>
                <li><a href="Memberships.html">Memberships</a></li>
                <li><a href="Personal Training.html">Personal Training</a></li>
                <li><a href="Blog.html">Blog</a></li>
                <li><a href="Contact Us.html">Contact Us</a></li>
                <li><a href="Sign Up.html">Sign Up</a></li>
                <li><a href="Login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <?php
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

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the username and password from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT password, role FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // Check if the username exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($stored_password, $role);
            $stmt->fetch();

            // Verify the password (plain text comparison)
            if ($password === $stored_password) {
                // Start session and store user information
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                // Redirect to different dashboards based on user role
                if ($role === 'admin') {
                    header("Location: Admin Dashboard.html");
                } elseif ($role === 'staff') {
                    header("Location: Staff Dashboard.html");
                } elseif ($role === 'customer') {
                    header("Location: Customer Dashboard.html");
                }                
                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Username not found.";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <a href="Classes.html">Classes</a>
                <a href="Memberships.html">Memberships</a>
                <a href="Personal Training.html">Personal Training</a>
                <a href="Blog.html">Blog</a>
                <a href="Contact Us.html">Contact Us</a>
            </div>
            <p>FitZone Fitness Center | Kurunegala | Contact : +94(0)760139886 | Email : fitzonefitnesscenter@gmail.com</p>
            <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>