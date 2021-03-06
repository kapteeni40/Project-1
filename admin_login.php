<?php 
session_start(); 

if (isset($_SESSION['userID'])) {
    header("Location: logout.php"); // Logs out first if already logged in
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/admin_login.css">
        <title>Admin Login</title>
        <?php
            if (isset($_GET["error"])) {
                $error = $_GET["error"];
                if ($error == "noLogin") {
                    echo "<script type='text/javascript'>";
                    echo "alert('You must be logged in to access the admin page!')";
                    echo "</script>";
                }
            }
        ?>
    </head>
    <body>
        <div class="container">
            <form action="login.php" method="post">
                <label for="username">Name: </label>
                <input type="text" name="username"><br>
                <label for="password">Password: </label>
                <input type="password" name="password"><br>
                <button type="submit" name="login-submit">Log in</button>
            </form>
        </div>
    </body>
</html>