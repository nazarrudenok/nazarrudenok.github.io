<?php
    $login = $_COOKIE['user'];
    $hexChange = $_POST['hex'];

    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    $mysql->query("UPDATE `users` SET `hex` = '$hexChange' WHERE `login` = '$login'");

    $mysql->close();

    header('location: /profile.php');
?>