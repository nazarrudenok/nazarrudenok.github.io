<?php
    setcookie('user', $user['username'], time() - 3600, '/');
    header('Location: /');
?>