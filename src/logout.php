<?php
    session_start();
    session_unset();
    if (ini_get('session.use_cookies')) { #ini_get() -- возвращает текущее значение PHP-настройки из конфигурации (php.ini), заданной на сервере
        $params = session_get_cookie_params(); #session_get_cookie_params() -- возвращает массив параметров cookie сессии
        setcookie(
            session_name(),       // 'PHPSESSID'
            '',                   // пустое значение
            time() - 42000,       // время в прошлом → браузер удалит cookie
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }
    session_destroy();
    header('Location: ../index.php');