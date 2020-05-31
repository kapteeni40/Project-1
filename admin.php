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
            // Displays any errors for the user from url parameters
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

            // Displays any errors for the user from session data
            if (isset($_SESSION["error"])) {
                $error = $_SESSION["error"];
                unset($_SESSION["error"]);
                if ($error == "notFound") {
                    echo "<script type='text/javascript'>";
                    echo "alert('No article of that ID was found!')";
                    echo "</script>";
                } else if ($error == "wrongentry_na" || $error == "wrongentry_ua") {
                    echo "<script type='text/javascript'>";
                    echo "alert('Tried to access a non-browsable page!')";
                    echo "</script>";
                } else {
                    echo "<script type='text/javascript'>";
                    echo "alert(" . $error . ")";
                    echo "</script>";
                }
            }

            // Displays other systems messages from url parameters
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

            if (isset($_SESSION["msg"])) {
                $msg = $_SESSION["msg"];
                unset($_SESSION["msg"]);
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
        <button type="button"><a href='/logout.php'>Log Out</a></button>
        <div class="container">
            <table>
            <?php 
                $sql = "SELECT ID, Headline FROM Articles";
                $result = mysqli_query($connection, $sql); // Uses open.php to send SQL query
                if (mysqli_num_rows($result) > 0) { // Checks if the query provided any results
                    while ($row = mysqli_fetch_assoc($result)) { // Displays results for every one found in database
                        echo '<tr><td><h3>' . $row["Headline"] . '</h3></td><td><a href="/article_edit.php?id=' . $row["ID"] . '"><h3>Edit article</h3></a></td><td><a href="/article_delete.php?id=' . $row["ID"] . '"><h3>Delete article</h3></a></td></tr>';
                    }
                } else {
                    echo "No results";
                }
                include 'close.php'; // Close connection
            ?>
            <tr><td></td><td><a href='/article_edit.php'><h3>New Article</h3></a></td></tr>
            </table>
        </div>
    </body>
</html>
