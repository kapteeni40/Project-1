<?php 
session_start(); 

if (!isset($_SESSION['userID'])) {
    header("Location: admin_login.php?error=noLogin"); // Has to be logged in to access
    exit();
} else {
    include 'config.php'; // Connection configuration
    include 'open.php'; // Database connection
}
?>