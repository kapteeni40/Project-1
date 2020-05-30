<?php 
session_start(); 

if (!isset($_SESSION['userID'])) {
    header("Location: admin_login.php?error=noLogin"); // Has to be logged in to access
    exit();
} else {
    include 'config.php'; // Connection configuration
    include 'open.php'; // Database connection
    $id = $_GET["id"];
    $sql = "DELETE FROM Articles WHERE ID=?";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: admin.php?error_ua=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "d", $id);
        mysqli_stmt_execute($stmt);
        header("Location: admin.php?msg=success_ua");
        exit();
    }
    include 'close.php';
}


?>