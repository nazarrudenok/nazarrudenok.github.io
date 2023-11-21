<?php
    $login = $_COOKIE['user'];
    if (empty($login)) {
        header('Location: /login.php');
        exit;
    }

    $text = htmlspecialchars($_POST['text'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');

    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    if ($mysql->connect_error) {
        die('Connection failed: ' . $mysql->connect_error);
    }

    $getUserData = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
    if ($getUserData) {
        $userData = $getUserData->fetch_assoc();
        $username = $userData['username'];

        date_default_timezone_set('Europe/Kiev');
        $currentDateTime = new DateTime();
        $mysqlDateTime = $currentDateTime->format('Y-m-d H:i:s');

        $insertQuery = "INSERT INTO `$username` (`text`, `description`, `time`) VALUES ('$text', '$description', '$mysqlDateTime')";
        if ($mysql->query($insertQuery) === TRUE) {
            $mysql->close();

            header('Location: /profile.php');
            exit;
        } else {
            echo 'Error inserting data: ' . $mysql->error;
        }
    } else {
        echo 'Error getting user data: ' . $mysql->error;
    }

    $mysql->close();
?>