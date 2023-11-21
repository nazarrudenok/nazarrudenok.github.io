<?php
    $login = $_COOKIE['user'];
    $usernameSearch = $_POST['search'];

    $mysql = new mysqli('sql307.infinityfree.com', 'if0_35465771', 'UT0C7O7FYvH', 'if0_35465771_registeredusers');

    

    $getUser = $mysql->query("SELECT * FROM `users` WHERE `username` = '$usernameSearch'");
    $searchedUser = $getUser->fetch_assoc();

    if (empty($searchedUser)) {
        header('Location: not-found.php');
        exit();
    }

    $getSelf = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
    $selfUser = $getSelf->fetch_assoc();
    $selfUsername = $selfUser['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Document</title>

    <link rel="stylesheet" href="/styles/css/search/search-friend.css">
    <link rel="stylesheet" href="/styles/css/mediaA.css">
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <p class="logo-text" onclick="window.location.href='/'">Chains</p>
            </div>
            <?php if (isset($_COOKIE['user']) && $_COOKIE['user'] !== false): ?>
                <p class="header-item" onclick="window.location.href='/profile.php'">Профіль</p>
            <?php else: ?>
                <p class="header-item" onclick="window.location.href='/index.php'">Увійти</p>
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
                            $username = $searchedUser['username'];
                            $hex = $searchedUser['hex'];

                            $usernameLetter = strtoupper(substr($username, 0, 1));

                            if ($hex == '#ffffff') {
                                echo "<div class='photo' style='background: $hex; color: #000000; border: 2px solid #fd1f4a'><h1>$usernameLetter</h1></div>";
                            } else {
                                echo "<div class='photo' style='background: $hex; border: 2px solid #fd1f4a'><h1>$usernameLetter</h1></div>";
                            }
                        ?>
                        
                        <div class="main-data">
                            <?php
                                $usernameSite = $searchedUser['username'];
                                $noteTime = $searchedUser['noteTime'];

                                $allFriends = $selfUser['friends'];
                                $allFriends = ltrim($allFriends, ',');
                                $allFriendsArray = explode(',', $allFriends);

                                if (in_array($usernameSearch, $allFriendsArray)) {
                                    echo "<div class='hello-settings'><h2><span class='username'>$usernameSite</span></h2><p class='your-friend'>Твій друг</p></div>";
                                    $note = $searchedUser['note'];
                                    echo "<div class='note-cont'>";
                                    echo "<div class='note-circle'>$noteTime</div><p class='note'>$note</p>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='hello-settings'><h2><span class='username'>$usernameSite</span></h2><p class='add-friend'><a href='/search/add-friend.php?name=$usernameSearch'>+</a></p></div>";
                                    $note = $searchedUser['note'];
                                    echo "<div class='note-cont'>";
                                    echo "<div class='note-circle'>$noteTime</div><p class='note'>$note</p>";
                                    echo "</div>";
                                }

                            ?>
                        </div>
                    </div>
                    <div class="second-data">
                        <h1 class="bio-title">Про себе</h1>
                        <div class="bio-cont">
                            <?php
                                $bio = $searchedUser['biography'];
                                echo "<p class='bio-text'>$bio</p>";
                            ?>
                        </div>
                        <h1 class="friends-list-title">
                            <?php
                                echo "Друзі $usernameSite";
                            ?>
                        </h1>
                        <div class="friends-cont">
                            <?php
                                $selfUsername = $selfUser['username'];

                                $result = $mysql->query("SELECT * FROM `users` WHERE `username`='$usernameSite'");
                                $user = $result->fetch_assoc();
                                $friends = $user['friends'];
                                $friendsArray = explode(',', $friends);
                                unset($friendsArray[0]);
                                $friendsArray = array_reverse(array_values($friendsArray));

                                if (empty($friendsArray)) {
                                    echo "<div class='key-value-none'><p>У $usernameSite ще немає друзів</p></div>";
                                } else {
                                    $displayedCount = 0;

                                    foreach ($friendsArray as $key => $value) {
                                        $key++;
                                        $displayValue = ($value == $selfUsername) ? "<a href='/search/view-user.php?name=$value' class='value-link'>Ти</a>" : "<a href='/search/view-user.php?name=$value' class='value-link'>$value</a>";
                                        echo "<div class='key-value'><p>$key</p>" . $displayValue . "</div>";
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
                    $getMyPosts = $mysql->query("SELECT * FROM `$usernameSite` ORDER BY id DESC");

                    if ($getMyPosts->num_rows === 0) {
                        echo "<h1 class='no-posts'>У $usernameSite ще немає дописів</h1>";
                    } else {
                        while ($row = $getMyPosts->fetch_assoc()) {
                            $row['text'] = nl2br($row['text']);
                    
                            $text = $row['text'];
                            $description = $row['description'];
                            $time = $row['time'];
                    
                            echo "<div class='post'>";
                            echo "<p class='text'>$text</p>";
                            echo "<p class='description'>$description</p>";
                            echo "<div class='data'><p class='time'>$time</p></div>";
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