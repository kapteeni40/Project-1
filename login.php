<?php
    if (isset($_POST['login-submit'])) {
        $user = $_POST["username"];
        $password = $_POST["password"];
        if (empty($user) || empty($password)) { // Empty field(s)
            header("Location: test.php?error=emptyfield");
            exit();
        }
        include 'config.php'; // Connection configuration
        include 'open.php'; // Database connection
        $sql = "SELECT Username, Password FROM Users WHERE Username=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) { // Checks for errors with Database
            header("Location: test.php?error=dberror");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
        }
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $passwordCheck = password_verify($password, $row['Password']);
            /* if ($passwordCheck == false) { 
                header("Location: test.php?error=wrongpassword");
                exit();
            } else if ($passwordCheck == true) { */
                session_start();
                $_SESSION['userID'] = $row['Username'];
                header("Location: test.php?login=success");
                exit();
            /* } else {
                header("Location: test.php?error=wrongpassword");
                exit();
            } */
        } else { // The correct user was not found in DB
            header("Location: test.php?error=noresults");
        }
    } else { // Someone tried to enter this page directly
        header("Location: test.php?error=wrongentry");
        exit();
    }
?>