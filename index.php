<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Document</title>

    <link rel="stylesheet" href="styles/css/styles.css">
    <link rel="stylesheet" href="styles/css/mediaA.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <p class="logo-text" onclick="window.location.href='#'">Chains</p>
            </div>
            <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] !== false): ?>
                <form action="/search/search-user.php" method="post" class="search-form">
                    <div class="search-cont">
                    <input type="text" name="search" placeholder="Пошук" autocomplete="off" class="search">
                        <button class='search-btn'><img src="styles/images/search.png" alt="" class="search-img"></button>
                    </div>
                </form>
                <p class="header-item" onclick="window.location.href='profile.php'">Профіль</p>
            <?php else: ?>
                <p class="header-item" onclick="window.location.href='register/register.php'">Зареєструватись</p>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] !== false): ?>
            <?php
                $login = $_COOKIE['user'];

                $mysql = new mysqli('localhost', 'root', '', 'registered-users');

                $getUserInfo = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
                $user = $getUserInfo->fetch_assoc();

                $friends = $user['friends'];
                $friendsArray = explode(',', $friends);
                unset($friendsArray[0]);
                $friendsArray = array_reverse(array_values($friendsArray));

                if (empty($friendsArray)) {
                    echo "<div class='key-value-none'><p>Додай когось в друзі, щоб переглядати пости</p></div>";
                } else {
                    $displayedCount = 0;
                    echo "<div class='friends-posts'>";
                    foreach ($friendsArray as $key => $value) {
                        $getAllPosts = $mysql->query("SELECT * FROM `$value` ORDER BY time DESC");
                    
                        if ($getAllPosts->num_rows > 0) {
                            $AllPosts = $getAllPosts->fetch_assoc();
                            $username = $value;
                            $text = nl2br($AllPosts['text']);
                            $description = $AllPosts['description'];
                            $time = $AllPosts['time'];
                            $dateTime = new DateTime($time);
                            $formattedTime = $dateTime->format('d/m H:i');

                            $getHex = $mysql->query("SELECT `hex` FROM `users` WHERE `username`='$username'");
                            $hex = $getHex->fetch_assoc();
                            $hex = $hex['hex'];

                            $usernameLetter = strtoupper(substr($username, 0, 1));

                            echo "<div class='post'>";
                            if ($hex == '#ffffff') {
                                echo "<div class='post-user-data'><div class='photo2' style='background: $hex; color: #000000; border: 2px solid #fd1f4a'><h1 class='letter'>$usernameLetter</h1></div><p class='post-username' onclick='window.location.href=`/search/view-user.php?name=$username`'>$username</p></div>";
                            } else {
                                echo "<div class='post-user-data'><div class='photo2' style='background: $hex; color: #ffffff; border: 2px solid #fd1f4a'><h1 class='letter'>$usernameLetter</h1></div><p class='post-username' onclick='window.location.href=`/search/view-user.php?name=$username`'>$username</p></div>";
                            }
                            echo "<p class='text'>$text</p>";
                            echo "<p class='description'>$description</p>";
                            echo "<div class='data'><p class='time'>$formattedTime</p></div>";
                            echo "</div>";
                        }
                    }
                    echo "</div>";
                }
            ?>
        <?php else: ?>
            <div class="main">
                <div class="all-cont">
                    <div class="info-container">
                        <h1 class="info-title">Знимка - це нова <img src="styles/images/flag-of-ukraine.png" alt="" class="ua"> соціальна мережа, де ви можете публікувати та ділитися із друзями моментами <span class="moments"></span></h1>
                        <p class="info-main">Ми надаємо необмежену пам'ять у хмарі та можливість публікувати необмежену кількість дописів, при цьому сервіс є повністю безкоштовним</p>
                        <p class="info-main">Увійди у свій профіль, щоб переглянути нові публікації друзів</p>
                    </div>
                    <div class="form-container">
                        <h1 class "form-title">Увійти</h1>
                        <form action="login/auth.php" method="post">
                            <input type="text" class="form-data" name="login" placeholder="Введи логін" autocomplete="off">
                            <input type="password" class="form-data" name="password" placeholder="Введи пароль" autocomplete="off">
                            <button type="submit" class="check-button">Увійти</button>
                        </form>
                        <p class="additional-reg">Ще не зареєстрований? Зареєструйся <span onclick="window.location.href='register/register.php'">тут</span></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>