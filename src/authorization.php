<?php
require_once __DIR__ . '/db.php';
$errors = []; #массив где хранятся все ошибки
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (empty($login) || empty($password)) {
        $errors[] = 'Данные заполнены не полностью';
    } else {
        if ($login === 'Conf2027' && $password === 'Demo77') {
            header('Location: admin.php');
            exit;
        } elseif (mb_strlen($login) < 6) {
            $errors[] = 'Логин должен содержать минимум 6 символов';
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $login)) { #preg_match(паттерн, субъект) Выполняет проверку на соответствие регулярному выражению
            $errors[] = 'Логин может содержать только латинские буквы и цифры';
        }elseif (mb_strlen($password) < 8) {
            $errors[] = 'Пароль должен содержать минимум 8 символов';
        }
        if (empty($errors)) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
            $stmt->execute([$login]);
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user_data['password'])) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user_data['user_id'];
                $_SESSION['login'] = $user_data['login'];
                $_SESSION['full_name'] = $user_data['full_name'];
                $_SESSION['phone_number'] = $user_data['phone_number'];
                $_SESSION['email'] = $user_data['email'];
                header('Location: homepage.php');
                exit;
            } else {
                $errors[] = 'Неверный логин или пароль';
            }
        }
    }
}
