<?php
    $login = $_COOKIE['user'];
    $usernameChange = $_POST['username'];

    if (mb_strlen($usernameChange) < 5 || mb_strlen($usernameChange) > 16) {
        echo 'Ім\'я користувача має містити від 5 до 16 символів';
        exit();
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $usernameChange)) {
        echo 'Ім\'я користувача може містити тільки літери та цифри';
        exit();
    }

    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    $checkExistingUser = $mysqli->prepare("SELECT 1 FROM `users` WHERE `username` = ?");
    $checkExistingUser->bind_param('s', $usernameChange);
    $checkExistingUser->execute();
    $existingUserResult = $checkExistingUser->get_result();
    $checkExistingUser->close();

    if ($existingUserResult->fetch_assoc()) {
        echo "Користувач з ім'ям користувача <b>$usernameChange</b> вже існує";
        exit();
    }

    $getOldUsername = $mysqli->prepare("SELECT `username` FROM `users` WHERE `login` = ?");
    $getOldUsername->bind_param('s', $login);
    $getOldUsername->execute();
    $oldUsernameResult = $getOldUsername->get_result();

    if ($oldUserData = $oldUsernameResult->fetch_assoc()) {
        $oldUsername = $oldUserData['username'];

        $updateUsername = $mysqli->prepare("UPDATE `users` SET `username` = ? WHERE `login` = ?");
        $updateUsername->bind_param('ss', $usernameChange, $login);
        $updateUsername->execute();
        $updateUsername->close();

        $renameTable = $mysqli->query("SHOW TABLES LIKE '$oldUsername'");
        
        if ($renameTable->num_rows > 0) {
            $mysqli->query("ALTER TABLE `$oldUsername` RENAME TO `$usernameChange`");

            header('Location: /profile.php');
            exit();
        } else {
            echo 'Стара таблиця не існує';
            exit();
        }
    } else {
        echo 'Не вдалося отримати дані користувача';
    }

    $mysqli->close();
?>
