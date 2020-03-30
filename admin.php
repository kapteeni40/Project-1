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
    </head>
    <body>
        <?php 
            include 'config.php'; // Connection configuration
            include 'open.php'; // Database connection
        ?>
        <a href='/logout.php'>Log Out</a>
        <?php 
            $sql = "SELECT ID, Headline FROM Articles";
            $result = mysqli_query($connection, $sql); // Uses open.php to send SQL query
            if (mysqli_num_rows($result) > 0) { // Checks if the query provided any results
                while ($row = mysqli_fetch_assoc($result)) { // Displays results for every one found in database
                    echo '<tr><td><a href="/article_edit.php?id=' . $row["ID"] . '"<h3>' . $row["Headline"] . '</h3><p></p></td></a></tr>';
                }
            } else {
                echo "No results";
            }
        ?>
    </body>
</html>