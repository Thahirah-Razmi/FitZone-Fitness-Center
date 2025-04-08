<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the class ID is set in the URL
if (isset($_GET['id'])) {
    $class_id = $_GET['id'];

    // Delete the class
    $sql = "DELETE FROM classes WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    
    if ($stmt->execute()) {
        header("Location: Class Management.php?message=Class deleted successfully.");
        exit;
    } else {
        echo "Error deleting class: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
