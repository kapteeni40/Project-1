<?php 
session_start(); 

if (!isset($_SESSION['userID'])) {
    header("Location: admin_login.php?error=noLogin"); // Has to be logged in to access
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/admin.css">
        <?php
            // Displays any errors for the user
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == "notFound") {
                    echo "<script type='text/javascript'>";
                    echo "alert('No article of that ID was found!')";
                    echo "</script>";
                } else if ($error == "wrongentry_na" || $error == "wrongentry_ua") {
                    echo "<script type='text/javascript'>";
                    echo "alert('Tried to access a non-browsable page!')";
                    echo "</script>";
                }
            }
            // Displays other systems messages
            if (isset($_GET["msg"])) {
                $msg = $_GET["msg"];
                if ($msg == "success_na") {
                    echo "<script type='text/javascript'>";
                    echo "alert('New article created successfully!')";
                    echo "</script>";
                } else if ($msg == "success_ua") {
                    echo "<script type='text/javascript'>";
                    echo "alert('Article updated successfully!')";
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
        <a href='/logout.php'>Log Out</a>
        <a href='/article_edit.php'><h3>New Article</h3></a>
        <?php 
            $sql = "SELECT ID, Headline FROM Articles";
            $result = mysqli_query($connection, $sql); // Uses open.php to send SQL query
            if (mysqli_num_rows($result) > 0) { // Checks if the query provided any results
                while ($row = mysqli_fetch_assoc($result)) { // Displays results for every one found in database
                    echo '<tr><td><a href="/article_edit.php?id=' . $row["ID"] . '"><h3>' . $row["Headline"] . '</h3><p></p></a></td></tr>';
                }
            } else {
                echo "No results";
            }
            include 'close.php'; // Close connection
        ?>
    </body>
</html>
