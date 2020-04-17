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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
        <title>Article Edit</title>
    </head>
    <body>
        <?php 
            if (!isset($_GET["id"])) {
                echo "<form action='new_article.php' method='post'>";
                echo "<label for='headline'>Headline: </label>";
                echo "<input type='text' name='headline'><br>";
                echo "<label for='imgurl'>Thumbnail: </label>";
                echo "<input type='text' name='imgurl'><br>";
                echo "<label for='text'>Text: </label>";
                echo "<input type='text' name='content'><br>";
                echo "<button type='submit' value='Submit' name='article-submit'>Submit</button>";
                echo "</form>";
            } else {
                $id = $_GET["id"];
                $sql = "SELECT Headline, ImgRef, Content FROM Articles WHERE ID=$id";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<form action='update_article.php?id=" . $id . "' method='post'>";
                        echo "<label for='headline'>Headline: </label>";
                        echo "<input type='text' name='headline' value='" . $row["Headline"] . "'><br>";
                        echo "<label for='imgurl'>Thumbnail: </label>";
                        echo "<input type='text' name='imgurl' value='" . $row["ImgRef"] . "'><br>";
                        echo "<label for='text'>Text: </label>";
                        echo "<input type='text' name='content' value='" . $row["Content"] . "'><br>";
                        echo "<button type='submit' value='Submit' name='article-submit'>Submit</button>";
                        echo "</form>";
                    }
                } else {
                    header("Location: admin.php?error=notFound"); // No article with specified id found
                    exit();
                }
            }
            include 'close.php'; // Close connection
        ?>
    </body>
</html>