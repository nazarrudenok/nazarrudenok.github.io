<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Document</title>

    <link rel="stylesheet" href="styles/css/profile/profie.css">
    <link rel="stylesheet" href="styles/css/mediaA.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <p class="logo-text" onclick="window.location.href='/'">Chains</p>
            </div>
            <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] !== false): ?>
                <form action="/search/search-user.php" method="post" class="search-form">
                    <div class="search-cont">
                    <input type="text" name="search" placeholder="Пошук" autocomplete="off" class="search">
                        <button class='search-btn'><img src="styles/images/search.png" alt="" class="search-img"></button>
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
            <div class="user-info">
                <div class="user-data">
                    <div class="first-data">
                        <?php
                            $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');
                            $login = $_COOKIE['user'];
                            $result = $mysql->query("SELECT `username` FROM `users` WHERE `login`='$login'");
                            $user = $result->fetch_assoc();
                            $username = $user['username'];
                            
                            $hexRequests = $mysql->query("SELECT `hex` FROM `users` WHERE `login`='$login'");
                            $hexResult = $hexRequests->fetch_assoc();
                            $hex = $hexResult['hex'];

                            $usernameLetter = strtoupper(substr($username, 0, 1));

                            if ($hex == '#ffffff') {
                                echo "<div class='photo' style='background: $hex; color: #000000; border: 2px solid #fd1f4a'><h1>$usernameLetter</h1></div>";
                            } else {
                                echo "<div class='photo' style='background: $hex; border: 2px solid #fd1f4a'><h1>$usernameLetter</h1></div>";
                            }
                        ?>
                        
                        <div class="main-data">
                            <?php
                                $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');
                                $login = $_COOKIE['user'];
                                $result = $mysql->query("SELECT * FROM `users` WHERE `login`='$login'");
                                $user = $result->fetch_assoc();
                                $usernameSite = $user['username'];
                                $noteTime = $user['noteTime'];
                                echo "<div class='hello-settings'><h2>Привіт, <span class='username'>$usernameSite</span>!</h2><a href='settings/settings.php' class='settings-link'><img src='styles/images/settings.png' class='settings-img'></a></div>";
                                $note = $user['note'];
                                echo "<div class='note-cont'>";
                                echo "<div class='note-circle'>$noteTime</div><p class='note'>$note</p>";
                                echo "</div>";
                            ?>
                        </div>
                        <div class="add-post-cont">
                            <?php
                                echo "<a href='/posts/newPost.php' class='add-post'>Новий допис</a>";
                                // echo "<p class='add-post-text'>опублікуй новий допис</p>";
                            ?>
                        </div>
                    </div>
                    <div class="second-data">
                        <h1 class="bio-title">Про себе</h1>
                        <div class="bio-cont">
                            <?php
                                $bio = $user['biography'];
                                echo "<p class='bio-text'>$bio</p>";
                            ?>
                        </div>
                        <h1 class="friends-list-title">Твої друзі</h1>
                        <div class="friends-cont">
                            <?php
                                $friends = $user['friends'];
                                $friendsArray = explode(',', $friends);
                                unset($friendsArray[0]);
                                $friendsArray = array_reverse(array_values($friendsArray));

                                if (empty($friendsArray)) {
                                    echo "<div class='key-value-none'><p>У тебе немає друзів</p></div>";
                                } else {
                                    $displayedCount = 0;
                                
                                    foreach ($friendsArray as $key => $value) {
                                        $key++;
                                        echo "<div class='key-value'><p>$key</p>"."<a href='/search/view-user.php?name=$value' class='value-link'>$value</a></div>";
                                        $displayedCount++;
                                        if ($displayedCount >= 5) {
                                            break;
                                        }
                                    }
                                    if (count($friendsArray) > 5) {
                                        echo "<a href='/' class='more-friends-link'><div class='more-friends'>Більше</div></a>";
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="my-posts">
                <?php
                    $getMyPosts = $mysql->query("SELECT * FROM `$username` ORDER BY id DESC");

                    if ($getMyPosts->num_rows === 0) {
                        echo "<h1 class='no-posts'>У тебе ще немає дописів</h1>";
                    } else {
                        while ($row = $getMyPosts->fetch_assoc()) {
                            $row['text'] = nl2br($row['text']);
                
                            $text = $row['text'];
                            $description = $row['description'];
                            $time = $row['time'];
                            $dateTime = new DateTime($time);
                            $formattedTime = $dateTime->format('d/m H:i');
                    
                            echo "<div class='post'>";
                            echo "<p class='text'>$text</p>";
                            echo "<p class='description'>$description</p>";
                            echo "<div class='data'><p class='delete' onclick='window.location.href=`/delete/delete.php?login=$login&post=$description`'>Видалити</p><p class='time'>$formattedTime</p></div>";
                            echo "</div>";
                        }
                    }
                    
                ?>
            </div>
        </div>
    </main>
    <script src="js/script.js"></script>
</body>
</html>