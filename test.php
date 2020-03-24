<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Test</title>
    </head>
    <body>
        <?php 
            if (isset($_SESSION['userID'])) {
                echo '<h1>Logged in!</h1>';
            } else {
                echo '<h1>Not logged in!</h1>';
            }
            
            print_r($_SESSION);
        ?>
    </body>
</html>
