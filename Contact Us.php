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
    // Database connection parameters
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

    // Check if POST data is set
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate input
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $phone_number = htmlspecialchars(trim($_POST['phone_number']));
        $message = htmlspecialchars(trim($_POST['message']));

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format'); window.history.back();</script>";
            exit();
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone_number, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone_number, $message);

        if ($stmt->execute()) {
            // Alert for success
            echo "<script>alert('Message sent successfully!'); window.location.href = 'Contact Us.html';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
        }

        // Close the statement
        $stmt->close();
    }

    // Close the connection
    $conn->close();
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