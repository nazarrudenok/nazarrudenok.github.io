<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../styles/css/styles.css">
    <link rel="stylesheet" href="/styles/css/mediaA.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <p class="logo-text" onclick="window.location.href='/'">Знимка</p>
            </div>
            <div class="header-items-container">
                <!-- <p class="header-item" onclick="window.location.href='#'">Публікації</p> -->
                <p class="header-item" onclick="window.location.href='../index.php'">Увійти</p>
            </div>
        </div>
    </header>
    <main>
        <div class="main">
            <div class="all-cont">
                <div class="info-container">
                    <h1 class="info-title">Знимка - це нова <img src="../styles/images/flag-of-ukraine.png" alt="" class="ua"> соціальна мережа, де ви можете публікувати та ділитися із друзями моментами <span class="moments"></span></h1>
                    <p class="info-main">Ми надаємо необмежену пам'ять у хмарі та можливість публікувати необмежену кількість дописів, при цьому сервіс є повністю безкоштовним</p>
                    <p class="info-main">Увійди у свій профіль, щоб переглянути нові публікації друзів</p>
                </div>
                <div class="form-container">
                    <h1 class="form-title">Зареєструватись</h1>
                    <form action="check.php" method="post">
                        <input type="text" class="form-data" name="login" placeholder="Придумай логін" autocomplete="off">
                        <input type="text" class="form-data" name="username" placeholder="Придумай ім'я користувача" autocomplete="off">
                        <input type="password" class="form-data" name="password" placeholder="Придумай пароль" autocomplete="off">
                        <button type="submit" class="check-button">Зареєструватись</button>
                    </form>
                    <p class="additional-reg">Вже маєш акаунт? Увійди <span onclick="window.location.href='../index.php'">тут</span></p>
                </div>
            </div>
        </div>
    </main>
    <script src="../js/script.js"></script>
</body>
</html>