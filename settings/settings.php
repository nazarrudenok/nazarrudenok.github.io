<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Document</title>

    <link rel="stylesheet" href="../styles/css/settings/setting.css">
    <link rel="stylesheet" href="/styles/css/mediaA.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <p class="header-item" onclick="window.location.href='/profile.php'">Назад</p>
            </div>
            <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] !== false): ?>
                <p class="header-item" onclick="window.location.href='../exit.php'">Вийти</p>
            <?php else: ?>
                <p class="header-item" onclick="window.location.href='../exit.php'">Увійти</p>
            <?php endif;?>
            </div>
        </div>
    </header>
    <main>
        <div class="main">
            <div class="update-items">
                <div class="item-cont" style="width: 100%; margin-bottom: 35px;">
                    <div class="settings-cont">
                        <img src="../styles/images/settings.png" alt="" style="margin-right: 5px; width: 30px;">
                        <h2>Налаштування</h2>
                    </div>
                    <!-- <p class="edit-profile">*тут ти можеш редагувати свій профіль</p> -->
                </div>
                <div class="item-cont">
                    <h2>Напиши нотатку</h2>
                    <p>*до 100 символів</p>
                    <form action="note-change.php" method="post">
                        <input type="text" class="form-data2" name="bio" placeholder="none - щоб видалити нотатку" autocomplete="off">
                        <button type="submit" class="check-button">Змінити нотатку</button>
                    </form>
                </div>
                <div class="item-cont">
                    <h2>Редагувати ім'я користувача</h2>
                    <p>*від 5 до 16 символів</p>
                    <form action="username-change.php" method="post">
                        <input type="text" class="form-data2" name="username" placeholder="Придумай нове ім'я користувача" autocomplete="off">
                        <button type="submit" class="check-button">Змінити ім'я користувача</button>
                    </form>
                </div>
                <div class="item-cont">
                    <h2>Редагувати біографію</h2>
                    <p>*до 300 символів</p>
                    <form action="bio-change.php" method="post">
                        <input type="text" class="form-data2" name="bio" placeholder="Напиши щось про себе" autocomplete="off">
                        <button type="submit" class="check-button">Змінити біографію</button>
                    </form>
                </div>
                <div class="item-cont">
                    <h2>Змінити колір аватарки</h2>
                    <p>*виберіть колір на паілтрі</p>
                    <form action="hex-change.php" method="post">
                        <input type="color" class="form-data2" name="hex" placeholder="Придумай нове ім'я користувача" autocomplete="off">
                        <button type="submit" class="check-button">Змінити колір аватарки</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>