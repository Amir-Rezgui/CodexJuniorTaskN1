<?php
session_start();

// Destroy the session
session_destroy();

// Redirect to the main page (index.php)
header("Location: index.php");
exit();
?>
