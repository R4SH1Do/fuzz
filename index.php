<?php
    session_start();
    $title = 'Регистрация';
    $content = 'html/reg';
    require_once __DIR__ . '/src/registration.php';
    require_once __DIR__ . '/html/main.php';
?>  