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
        <h1>User Management</h1>

        <?php
        // Start session to display feedback messages
        session_start();
        if (isset($_SESSION['message'])) {
            echo "<p>{$_SESSION['message']}</p>";
            unset($_SESSION['message']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Membership Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch users from the database
                $sql = "SELECT user_id, username, password, full_name, email, phone_number, role, membership_type FROM users";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['user_id']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['full_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone_number']}</td>
                                <td>{$row['role']}</td>
                                <td>{$row['membership_type']}</td>
                                <td>
                                    <a href='Edit User.php?id={$row['user_id']}' class='btn'>Edit</a>
                                </td>
                                <td>
                                    <a href='Delete User.php?id={$row['user_id']}' class='btn delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No users found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>

    <div class="button-container">
        <a href="Add User.php" class="btnadd">Add New User</a>
    </div>

    <footer>
        <p>&copy; 2024 FitZone Fitness Center. All rights reserved.</p>
    </footer>
</body>

</html>