<?php
    $login = $_COOKIE['user'];
    $noteChange = $_POST['bio'];

    date_default_timezone_set('Europe/Kiev');
    $currentDateTime = new DateTime();
    $currentTime = $currentDateTime->format('H:i');
    $daysOfWeek = [
        "Monday"=>"Понеділок",
        "Tuesday"=>"Вівторок",
        "Wednesday"=>"Середа",
        "Thursday"=>"Четвер",
        "Friday"=>"П'ятниця",
        "Saturday"=>"Субота",
        "Sunday"=>"Неділя",
    ];

    $dayOfWeek = $daysOfWeek[$currentDateTime->format('l')];
    $currentTime = $dayOfWeek.' '.$currentTime;

    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    if ($noteChange == 'none') {
        $mysql->query("UPDATE `users` SET `note` = '🌙' WHERE `login` = '$login'");
        $mysql->query("UPDATE `users` SET `noteTime` = '$currentTime' WHERE `login` = '$login'");
    } else {
        $mysql->query("UPDATE `users` SET `note` = '$noteChange' WHERE `login` = '$login'");
        $mysql->query("UPDATE `users` SET `noteTime` = '$currentTime' WHERE `login` = '$login'");
    }

    $mysql->close();

    header('location: /profile.php');
?>