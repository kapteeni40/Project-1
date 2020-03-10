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
                <img class="logo" src="https://images3.memedroid.com/images/UPLOADED279/5bd6cc01a70a6.jpeg" alt="logo">
            </div>
            <div class="login_container">Login here possibly</div>
        </header>
        <div class="content_container">
            <div class="banner_1">
                <h2>BANNER</h2>
            </div>
            <div class="banner_2">
                <h2>BANNER</h2>
            </div>
            <?php
                if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $sql = "SELECT Headline, ImgRef, Text FROM Articles WHERE ID=$id";
                    $result = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<h3 class="article_head">' . $row["Headline"] . '</h3>';
                            echo '<img class="article_img" src="' . $row["ImgRef"] . '" alt="Image">';
                            echo '<p class="article_text">' . $row["Text"] . '</p>';
                        }
                    } else {
                        echo "No results";
                    }
                } else {
                    echo "Error: No defined Article ID!";
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