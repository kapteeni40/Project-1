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
        <title>Admin Login</title>
    </head>
    <body>
        <form action="login.php" method="post">
            <label for="username">Name: </label>
            <input type="text" name="username"><br>
            <label for="password">Password: </label>
            <input type="password" name="password"><br>
            <button type="submit" name="login-submit">Log in</button>
        </form>
    </body>
</html>