<?php 
session_start();

if (isset($_POST['article-submit'])) {
    include 'config.php'; // Connection configuration
    include 'open.php'; // Database connection
    $headline = $_POST["headline"];
    $imgurl = $_POST["imgurl"];
    $content = $_POST["content"];
    $sql = "INSERT INTO Articles (Headline, ImgRef, Content) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: admin.php?error_ua=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $headline, $imgurl, $content);
        mysqli_stmt_execute($stmt);
        header("Location: admin.php?msg=success_ua");
        exit();
    }
    include 'close.php';
} else { // Someone tried to enter this page directly
    header("Location: admin.php?error=wrongentry_na");
    exit();
}
?>