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

    // Only process form when submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data safely
        $full_name = isset($_POST['full-name']) ? $_POST['full-name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $role = 'customer';  // Default role set to 'customer'

        // Get membership only for customers
        if ($role === 'customer') {
            $membership = isset($_POST['membership']) ? $_POST['membership'] : NULL;
        } else {
            $membership = NULL; // No membership for admin or staff
        }

        // Generate username
        $first_name = explode(' ', $full_name)[0]; // Get first name from full name
        $random_number = rand(100, 999); // Generate random 3-digit number
        $username = strtolower($first_name) . $random_number; // Create username (e.g., john123)

        // Check if username already exists
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($result->num_rows > 0) {
            // Regenerate new username if exists
            $random_number = rand(100, 999);
            $username = strtolower($first_name) . $random_number;
            $stmt->bind_param("s", $username); // Bind the new username
            $stmt->execute(); // Recheck the new username
            $result = $stmt->get_result();
        }

        // Insert data into the database
        $sql = "INSERT INTO users (full_name, email, username, password, phone_number, membership_type, role) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $full_name, $email, $username, $password, $phone, $membership, $role);

        if ($stmt->execute()) {
            echo "Sign-up successful! Your username is: " . $username;
        } else {
            echo "Error: " . $stmt->error;
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