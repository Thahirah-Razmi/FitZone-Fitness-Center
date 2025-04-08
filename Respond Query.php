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
                <li><a href="Membership Management.php">Memberships</a></li>
                <li><a href="Appointments.php">Appointments</a></li>
                <li><a href="Queries.php">Customer Queries</a></li>
                <li><a href="Logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Respond to Customer Query</h1>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch query details
        if (isset($_GET['id'])) {
            $query_id = $_GET['id'];
            $sql = "SELECT * FROM contact_messages WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $query_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query = $result->fetch_assoc();
            } else {
                echo "<p>Query not found.</p>";
                exit();
            }
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = $_POST['response'];
            $status = 'Responded';

            // Update the query with the response
            $sql = "UPDATE contact_messages SET response = ?, status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $response, $status, $query_id);

            if ($stmt->execute()) {
                echo "<p>Response sent successfully!</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }
        }

        $conn->close();
        ?>

        <form action="Respond Query.php?id=<?php echo $query_id; ?>" method="POST">
            <label for="response">Your Response:</label>
            <textarea name="response" rows="5" required><?php echo isset($query['response']) ? htmlspecialchars($query['response']) : ''; ?></textarea>

            <button type="submit">Send Response</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>