<?php
    if (isset($_POST['login-submit'])) {
        $user = $_POST["username"];
        $password = $_POST["password"];
        $rpassword = $_POST["rpassword"];
        if (empty($user) || empty($password)) { // Empty field(s)
            header("Location: user_registration.php?error=emptyfield");
            exit();
        }
        if ($password != $rpassword) { // Password repeated inconrrectly
            header("Location: user_registration.php?error=repeatFailure");
            exit();
        } else {
            include 'config.php'; // Connection configuration
            include 'open.php'; // Database connection
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO 'Users' ('Username', 'Password') VALUES (´" . $user . "´, ´" . $hashedPassword . "´)";
            if (mysqli_query($connection, $sql)) {
                header("Location: admin.php?msg=success_reg");
                exit();
            } else {
                $error = mysqli_error($connection);
                $header = "Location: user_registration.php?error_reg";
                header($header);
                exit();
            }
        }
        
    } else { // Someone tried to enter this page directly
        header("Location: user_registration.php?error=wrongentry");
        exit();
    }
?>