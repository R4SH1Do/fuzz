<?php
require_once __DIR__ . '/db.php';
$errors = []; #массив где хранятся все ошибки
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if (empty($login) || empty($password) || empty($full_name) || empty($phone_number) || empty($email)) {
        $errors[] = 'Данные заполнены не полностью';
    } else {
        if (mb_strlen($login) < 6) {
            $errors[] = 'Логин должен содержать минимум 6 символов';
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $login)) { #preg_match(паттерн, субъект) Выполняет проверку на соответствие регулярному выражению
            $errors[] = 'Логин может содержать только латинские буквы и цифры';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { #filter_var -- фильтрует переменные, FILTER_VALIDATE_EMAIL -- встроенный фильтр, проверяющий корректность email по RFC-стандарту
            $errors[] = 'Неверный формат email';
        }
        if (!preg_match('/^[0-9]+$/', $phone_number)) {
            $errors[] = 'Телефон должен состоять только из цифр';
        }
        if (mb_strlen($password) < 8) {
            $errors[] = 'Пароль должен содержать минимум 8 символов';
        } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
            $errors[] = 'Пароль должен состоять только из латинских букв, символов и цифр';
        }
        if (empty($errors)) {
            $stmt = $pdo->prepare("SELECT user_id FROM users WHERE login = ? OR email = ?");
            $stmt->execute([$login, $email]);
            if ($stmt->fetch()) { #fetch -- извлекает одну строку из результата запроса, если ничего не извлечено, то вернет false и код пойдет дальше
                $errors[] = 'Такой логин или email уже занят';
            }

        }
        if (empty($errors)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (login, password, full_name, phone_number, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$login, $hash, $full_name, $phone_number, $email]);
            header('Location: homepage.php');
            exit;
        }
    }


}
?>