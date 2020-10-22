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
            $sql = "INSERT INTO Users (Username, Password) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($connection);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                $_SESSION["error"] = $connection->error;
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $user, $hashedPassword);
                mysqli_stmt_execute($stmt);
            }
            header("Location: admin.php");
            exit();
            include 'close.php';
        }
        
    } else { // Someone tried to enter this page directly
        header("Location: user_registration.php?error=wrongentry");
        exit();
    }
?>