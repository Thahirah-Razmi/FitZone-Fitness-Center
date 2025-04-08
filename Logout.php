<?php
// Start the session
session_start();

// Destroy all sessions
session_destroy();

// Redirect to the login page
header("Location: Login.html");
exit;
?>
