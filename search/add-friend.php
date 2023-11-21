<?php
    $login = $_COOKIE['user'];
    $username = $_GET['name'];

    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    $selfReq = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
    $self = $selfReq->fetch_assoc();
    
    $getUser = $mysql->query("SELECT * FROM `users` WHERE `username` = '$username'");
    $userData = $getUser->fetch_assoc();

    if($getUser->num_rows === 0) {
        echo 'Такого користувача не існує';
        exit();
    } else if ($username == $self['username']) {
        header('Location: /search/self.php');
        exit();
    }

    $checkQuery = $mysql->query("SELECT `friends` FROM `users` WHERE `login` = '$login'");
    $userData2 = $checkQuery->fetch_assoc();
    $currentFriends = $userData2['friends'];
    
    if (!strpos($currentFriends, $username)) {
        $writeFriend = $mysql->query("UPDATE `users` SET `friends` = CONCAT(`friends`, ',', '$username') WHERE `login` = '$login'");
    } else {
        header('Location: /search/already.php');
        exit();
    }

    $mysql->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3;url=/">
    <title>Document</title>
</head>
<body>
    <?php
        echo "<h1>Тепер ти дружиш з <b>$username</b>!</h1>";
    ?>
    <h3>Перенапрявляю на головну сторіку...</h3>
</body>
</html>
