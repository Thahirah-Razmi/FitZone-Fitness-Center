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
        <h1>Customer Queries</h1>

        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch customer queries from the database
        $sql = "SELECT * FROM contact_messages";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>Query ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Response</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['status']}</td>
                        <td>{$row['response']}</td>
                        <td>
                            <a href='Respond Query.php?id={$row['id']}' class='btn'>Respond</a>
                        </td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<p>No queries found</p>";
        }

        $conn->close();
        ?>
    </main>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>
</html>
