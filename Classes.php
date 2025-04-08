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
    $class_type = $_POST['class_type'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT c.class_name, c.start_time, c.end_time, t.trainer_name, c.description FROM classes c JOIN trainers t ON c.trainer_id = t.trainer_id WHERE c.class_type = ? ");
    $stmt->bind_param("s", $class_type);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h2>Available Schedules for " . ucfirst($class_type) . ":</h2>";
        echo "<p>" . ucfirst($class_type) . " Class Name with the start time, end time, trainer and it's description: </p><br>";
        echo "<ul>";
        // Output the schedule data
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['class_name'] . "<br>" . $row['start_time'] . " - " . $row['end_time'] . "<br>" . $row['trainer_name'] . "<br>" . $row['description'] . "</li><br>";
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