<?php
    session_start();

    if (!isset($_SESSION['logged_in'])) {
        include_once 'user_auth.php';
    } else {
        echo '<div class="welcome-container">';
        echo '<h1>Hello, ' . $_COOKIE['user_name'] . '<h1>';
        include_once 'logout.php';
        echo '</div>';
    }
