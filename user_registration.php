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
        <title>User Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            <form action="registration.php" method="post">
                <label for="username">New user's username: </label>
                <input type="text" name="username"><br>
                <label for="password">New user's password: </label>
                <input type="password" name="password"><br>
                <label for="password">Repeat password: </label>
                <input type="password" name="rpassword"><br>
                <button type="submit" name="login-submit">Register</button>
            </form>
        </div>
    </body>
</html>