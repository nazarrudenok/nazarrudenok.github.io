<?php
    $login = $_GET['login'];
    $post = $_GET['post'];
    
    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    $getUserData = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
    $userData = $getUserData->fetch_assoc();
    $username = $userData['username'];

    $mysql->query("DELETE FROM `$username` WHERE `description` = '$post'");

    header('Location: /profile.php');
?>