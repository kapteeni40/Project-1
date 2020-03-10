<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
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
            <div class="content">
                <table>
                <?php 
                    $sql = "SELECT ID, Headline, ImgRef FROM Articles";
                    $result = mysqli_query($connection, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr><td><a href="/article.php?id=' . $row["ID"] . '"<h3>' . $row["Headline"] . '</h3><p></p></td></a></tr>';
                        }
                    } else {
                        echo "No results";
                    }
                ?>
                </table>
            </div>
        </div>
        <footer>
            <div class="contact_info"></div>
            <div class="social_media"></div>
        </footer>
        <?php include 'close.php'; // Close connection ?>
    </body>
</html>