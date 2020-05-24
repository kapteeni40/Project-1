<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
        <title>Frontpage</title>
        <?php
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == "notFound") {
                    echo "<script type='text/javascript'>";
                    echo "alert('No article of that ID was found!')";
                    echo "</script>";
                }
            }
        ?>
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
            <table>
            <?php 
                $sql = "SELECT * FROM Articles";
                $result = mysqli_query($connection, $sql);
                $total_articles = mysqli_num_rows($result); // Gets the total number of articles from the database
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Checks if the page number is specified and check if it's a number, if not returns the default page number
                $num_results_on_page = 3; // Number of results per page
                $calc_page = ($page - 1) * $num_results_on_page; //Calculates the page of results

                $sql = "SELECT ID, Headline, ImgRef FROM Articles LIMIT $calc_page, $num_results_on_page";
                $result = mysqli_query($connection, $sql); // Uses open.php to send SQL query
                if (mysqli_num_rows($result) > 0) { // Checks if the query provided any results
                    while ($row = mysqli_fetch_assoc($result)) { // Displays results for every one found in database
                        echo '<tr><td><a href="/article.php?id=' . $row["ID"] . '"><h3>' . $row["Headline"] . '</h3><p></p></a></td></tr>';
                    }
                } else {
                    echo "No results";
                }
            ?>
            </table>
            <?php if (ceil($total_articles / $num_results_on_page) > 0): ?>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                    <li class="prev"><a href="/?page=<?php echo $page-1 ?>">Prev</a></li>
                    <?php endif; ?>

                    <?php if ($page > 3): ?>
                    <li class="start"><a href="/?page=1">1</a></li>
                    <li class="dots">...</li>
                    <?php endif; ?>

                    <?php if ($page-2 > 0): ?><li class="page"><a href="/?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
                    <?php if ($page-1 > 0): ?><li class="page"><a href="/?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

                    <li class="currentpage"><a href="/?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                    <?php if ($page+1 < ceil($total_articles / $num_results_on_page)+1): ?><li class="page"><a href="/?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
                    <?php if ($page+2 < ceil($total_articles / $num_results_on_page)+1): ?><li class="page"><a href="/?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

                    <?php if ($page < ceil($total_articles / $num_results_on_page)-2): ?>
                    <li class="dots">...</li>
                    <li class="end"><a href="/?page=<?php echo ceil($total_articles / $num_results_on_page) ?>"><?php echo ceil($total_articles / $num_results_on_page) ?></a></li>
                    <?php endif; ?>

                    <?php if ($page < ceil($total_articles / $num_results_on_page)): ?>
                    <li class="next"><a href="/?page=<?php echo $page+1 ?>">Next</a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
        <footer>
            <div class="contact_info"></div>
            <div class="social_media"></div>
        </footer>
        <?php include 'close.php'; // Close connection ?>
    </body>
</html>