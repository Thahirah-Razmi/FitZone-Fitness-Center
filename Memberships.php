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

    // Get selected class type from the form
    $membership_name = $_POST['membership-plan'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT membership_name, price, description, duration, benefits FROM membership WHERE membership_name = ?");
    $stmt->bind_param("s", $membership_name);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Available Memberships for " . ucfirst($membership_name) . ":</h2>";
        echo "<p>" . ucfirst($membership_name) . " Membership plans with the price, description and benefits: </p><br>";
        echo "<ul>";
        // Output the schedule data
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['duration'] . " -  Rs. " . $row['price'] . "<br>" . $row['description'] . "<br>" . $row['benefits'] . "</li><br>";
        }
        echo "</ul>";
    } else {
        echo "No schedules available for the selected class.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
    ?>

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