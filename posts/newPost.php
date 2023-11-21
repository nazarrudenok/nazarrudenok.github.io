<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/styles/css/posts/posts.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <p class="logo-text" onclick="window.location.href='/profile.php'">Назад</p>
            </div>
            <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] !== false): ?>
                <form action="/search/search-user.php" method="post" class="search-form">
                    <div class="search-cont">
                    <input type="text" name="search" placeholder="Знайди користувача" autocomplete="off" class="search">
                        <button class='search-btn'><img src="/styles/images/search.png" alt="" class="search-img"></button>
                    </div>
                </form>
                <p class="header-item" onclick="window.location.href='exit.php'">Вийти</p>
            <?php else: ?>
                <p class="header-item" onclick="window.location.href='exit.php'">Увійти</p>
            <?php endif;?>
            </div>
        </div>
    </header>
    <main>
        <div class="main">
            <h1 class="new-post-title">Створи новий допис</h1>
            <div class="new-post-cont">
                <div class="data-form">
                <form action="newPostBack.php" method="post" class="form">
                    <p class="title-title">*Напиши, що думаєш</p>
                    <textarea name="text" class="data-input" cols="30" rows="10" placeholder="Напиши щось"></textarea>

                    <p class="title-title">*Напиши опис</p>
                    <textarea name="description" class="data-input" cols="30" rows="10" placeholder="Напиши щось"></textarea>

                    <button class="btn-submit">Опублікуй допис</button>
                </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>