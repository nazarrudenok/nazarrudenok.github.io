<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/styles/css/errors.css">
</head>
<body>
    <main>
        <?php
            $login = filter_var(trim($_POST['login']));
            $username = filter_var(trim($_POST['username']));
            $password = filter_var(trim($_POST['password']));

            if(mb_strlen($login) < 5 || mb_strlen($login) > 16) {
                echo 'Логін має містити від 5 до 16 символів';
                exit();
            } else if(mb_strlen($username) < 5 || mb_strlen($username) > 16) {
                echo 'Ім\'я користувача має містити від 5 до 16 символів';
                exit();
            } else if(mb_strlen($password) < 8 || mb_strlen($password) > 20) {
                echo 'Пароль має містити від 8 до 20 символів';
                exit();
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
                echo 'Ім\'я користувача може містити тільки літери та цифри';
                exit();
            }

            $password = md5($password."923893ur923ur98ru393u2r9");

            $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

            $login_check = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
            $username_check = $mysql->query("SELECT * FROM `users` WHERE `username`='$username'");

            if ($login_check->num_rows > 0) {
                echo 'Користувач з таким логіном вже існує';
                exit();
            } elseif ($username_check->num_rows > 0) {
                echo 'Користувач з таким ім\'ям вже існує';
                exit();
            }

            $mysql->query("INSERT INTO `users` (`login`, `username`, `password`) VALUES('$login', '$username', '$password')");

            $sql = "CREATE TABLE IF NOT EXISTS $username (
                id INT AUTO_INCREMENT UNIQUE,
                text TEXT,
                description VARCHAR(255),
                time DATETIME
            )";    


            $mysql->query($sql);

            $mysql->close();

            setcookie('user', $login, time() + 3600 * 24 * 30, '/');

            header('Location: /');
        ?>
    </main>
</body>
</html>