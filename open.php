<?php
    $connection = mysqli_connect($servername, $username, $password, $dbname); // New connection
    if ($connection->connect_error) { // Connection check
        die("Connection failure: " . $connection->connect_error);
    }
?>