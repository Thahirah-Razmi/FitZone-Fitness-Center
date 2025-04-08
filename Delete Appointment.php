<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'fitzone_fitness_center');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the appointment ID is set
if (isset($_GET['id'])) {
    $appointment_id = $_GET['id'];

    // Delete the appointment
    $sql = "DELETE FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['message'] = "Appointment deleted successfully.";
    } else {
        echo "Error deleting appointment: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

header("Location: Appointments.php");
exit;

$conn->close();
