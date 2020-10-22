<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/article.css">
    </head>
    <body>
        <?php 
            include 'config.php'; // Connection configuration
            include 'open.php'; // Database connection
        ?>
        <header>
            <div class="logo_container">
                <a href="https://trilobate-delay.000webhostapp.com/"><img class="logo" src="/src/TrilobateDelay.png" alt="logo"></a>
            </div>
        </header>
        <div class="content">
            <?php // checking if an article with the given id exists, then fetches the result from backend and prints it on screen
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $sql = "SELECT Headline, ImgRef, Content FROM Articles WHERE ID=$id";
                    $result = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<h3 class="article_head">' . $row["Headline"] . '</h3>';
                            echo '<img class="article_img" src="' . $row["ImgRef"] . '" alt="Image">';
                            echo '<p class="article_text">' . nl2br($row["Content"]) . '</p>';
                        }
                    } else {
                        echo "No results";
                    }
                } else {
                    header("Location: index.php?error=notFound"); // No article with specified id found
                    exit();
                }
            ?>
        </div>
        <footer>
            <div class="contact_info"></div>
            <div class="social_media"></div>
        </footer>
        <?php include 'close.php'; // Close connection ?>
    </body>
</html>