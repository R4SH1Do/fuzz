<?php
    session_start();
    $title = 'Авторизация';
    $content = 'html/auth';
    require_once __DIR__ . '/src/authorization.php';
    require_once __DIR__ . '/html/main.php';
?>  