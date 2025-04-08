<?php
// Start session to display feedback messages
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the membership ID is set in the URL
if (isset($_GET['id'])) {
    $membership_id = $_GET['id'];

    // Delete the membership
    $sql = "DELETE FROM membership WHERE membership_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $membership_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Membership deleted successfully.";
    } else {
        $_SESSION['message'] = "Error deleting membership: " . $conn->error;
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}

header("Location: Membership Management.php");
exit;

$conn->close();
