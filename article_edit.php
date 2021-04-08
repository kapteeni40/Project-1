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
        <link rel="stylesheet" href="css/article_edit.css">
        <title>Article Edit</title>
    </head>
    <body>
        <?php 
            /* Checks if the edit feature has been given an id as a parameter. If yes, then fills the form fields with the article text
             and edits the article. If no id is found, instead creates a new article. 
            */
            if (!isset($_GET["id"])) {
                echo "<div class='container'><form action='new_article.php' method='post'>";
                echo "<label for='headline'>Headline: </label>";
                echo "<input type='text' name='headline'><br>";
                echo "<label for='imgurl'>Thumbnail: </label>";
                echo "<input type='text' name='imgurl'><br>";
                echo "<label for='text'>Text: </label>";
                echo "<textarea name='content'></textarea><br>";
                echo "<button type='submit' value='Submit' name='article-submit'>Submit</button>";
                echo "</form></div>";
            } else {
                $id = $_GET["id"];
                $sql = "SELECT Headline, ImgRef, Content FROM Articles WHERE ID=$id";
                $result = mysqli_query($connection, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='container'><form action='update_article.php?id=" . $id . "' method='post'>";
                        echo "<label for='headline'>Headline: </label>";
                        echo "<input type='text' name='headline' value='" . $row["Headline"] . "'><br>";
                        echo "<label for='imgurl'>Thumbnail: </label>";
                        echo "<input type='text' name='imgurl' value='" . $row["ImgRef"] . "'><br>";
                        echo "<label for='text'>Text: </label>";
                        echo "<textarea name='content'>" . $row["Content"] . "</textarea><br>";
                        echo "<button type='submit' value='Submit' name='article-submit'>Submit</button>";
                        echo "</form></div>";
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