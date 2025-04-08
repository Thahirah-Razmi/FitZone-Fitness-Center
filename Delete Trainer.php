<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['delete_id'])) {
    $trainer_id = $_GET['delete_id'];

    // Delete the trainer from the database
    $sql = "DELETE FROM trainers WHERE trainer_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $trainer_id);

    if ($stmt->execute()) {
        header("Location: Trainer Management.php?message=Trainer deleted successfully!");
        exit;
    } else {
        echo "Error deleting trainer: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit;
}

$conn->close();
