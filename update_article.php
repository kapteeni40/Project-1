<?php 
session_start();

if (isset($_POST['article-submit'])) {
    include 'config.php'; // Connection configuration
    include 'open.php'; // Database connection
    $id = $_GET["id"];
    $headline = $_POST["headline"];
    $imgurl = $_POST["imgurl"];
    $text = $_POST["text"];
    $sql = "UPDATE Articles SET ´Headline´ = ´" . $headline . "´, ´ImgRef´ = ´" . $imgurl . "´, ´Text´ = ´" . $text . "´ WHERE ´ID´ = " . $id;
    if (mysqli_query($connection, $sql)) {
        header("Location: admin.php?msg=success");
        exit();
    } else {
        header("Location: admin.php?error_ua=" . mysqli_error($connection));
        exit();
    }
    include 'close.php';
} else { // Someone tried to enter this page directly
    header("Location: admin.php?error=wrongentry_ua");
    exit();
}
?>