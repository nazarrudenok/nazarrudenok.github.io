<?php
    $login = filter_var(trim($_POST['login']));
    $password = filter_var(trim($_POST['password']));

    if(mb_strlen($login) < 5 || mb_strlen($login) > 16) {
        echo 'Логін має містити від 5 до 16 символів';
        exit();
    } else if(mb_strlen($password) < 8 || mb_strlen($password) > 20) {
        echo 'Логін має містити від 5 до 16 символів';
        exit();
    }

    $password = md5($password."923893ur923ur98ru393u2r9");
    
    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');
    
    $result = $mysql->query("SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'");
    $user = $result->fetch_assoc();

    if($result->num_rows === 0) {
        echo 'Такого користувача не існує';
        exit();
    }

    setcookie('user', $user['login'], time() + 3600 * 24 * 30, '/');

    $mysql->close();

    header('location: /profile.php')
?>