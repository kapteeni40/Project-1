<?php 
session_start();

if (isset($_POST['article-submit'])) {
    include 'config.php'; // Connection configuration
    include 'open.php'; // Database connection
    $headline = $_POST["headline"];
    $imgurl = $_POST["imgurl"];
    $content = $_POST["content"];
    $sql = "INSERT INTO 'Articles' ('Headline', 'ImgRef', 'Content') 
    VALUES (´" . $headline . "´, ´" . $imgurl . "´, ´" . $content . "´)";
    if (mysqli_query($connection, $sql)) {
        header("Location: admin.php?msg=success_na");
        exit();
    } else {
        $error = mysqli_error($connection);
        header("Location: admin.php?error_na=" . mysqli_error($connection));
        exit();
    }
} else { // Someone tried to enter this page directly
    header("Location: admin.php?error=wrongentry_na");
    exit();
}
?>