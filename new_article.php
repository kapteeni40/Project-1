<?php 
session_start();

if (isset($_POST['article-submit'])) {
    include 'config.php'; // Connection configuration
    include 'open.php'; // Database connection
    $headline = $_POST["headline"];
    $imgurl = $_POST["imgurl"];
    $text = $_POST["text"];
    $sql = "INSERT INTO 'Articles' ('Headline', 'ImgRef', 'Text') 
    VALUES (" . $headline . ", " . $imgurl . ", " . $text . ")";
    if (mysqli_query($connection, $sql)) {
        header("Location: admin.php?msg=success");
        exit();
    } else {
        header("Location: admin.php?error=dberror");
        exit();
    }
} else { // Someone tried to enter this page directly
    header("Location: admin.php?error=wrongentry");
    exit();
}
?>