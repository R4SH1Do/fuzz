<?php
    require_once __DIR__ . '/config.php';
    try{

        $pdo = new PDO(
            'mysql:host='. DB_HOST .';port='. DB_PORT .';dbname='. DB_NAME,
            DB_USER,
            DB_PASSWORD
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){ 

        error_log($e);
        die('Ошибка подключения к базе данных.');

    }