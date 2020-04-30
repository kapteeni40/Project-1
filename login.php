<?php
    if (isset($_POST['login-submit'])) {
        $user = $_POST["username"];
        $password = $_POST["password"];
        if (empty($user) || empty($password)) { // Empty field(s)
            header("Location: admin_login.php?error=emptyfield");
            exit();
        }
        include 'config.php'; // Connection configuration
        include 'open.php'; // Database connection
        $sql = "SELECT Username, Password FROM Users WHERE Username=?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) { // Checks for errors with Database
            header("Location: admin_login.php?error=dberror");
        } else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
        }
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            /* $passwordCheck = password_verify($password, $row['Password']);
            if (!$passwordCheck) {
                header("Location: admin_login.php?error=wrongpassword");
                exit();
            } else {  */
                session_start();
                $_SESSION['userID'] = $row['Username'];
                header("Location: admin.php");
                exit();
            /* } */
        } else { // The correct user was not found in DB
            header("Location: admin_login.php?error=noresults");
        }
    } else { // Someone tried to enter this page directly
        header("Location: admin_login.php?error=wrongentry");
        exit();
    }
?>