<?php
session_start();
$errors = [];
if (empty($_SESSION['login'])) {
    header('Location: ../auth.php');
    exit;
} else {
    require_once 'db.php';
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id= ?");
    $stmt->execute([$user_id, $product_id]);
    $products_in_cart = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT price FROM `products` WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product_price = $stmt->fetch(PDO::FETCH_ASSOC);

    $product_price = $product_price['price'];
    if ($products_in_cart) {
        $product_quantity = ++$products_in_cart['quantity'];
        $product_price *= $product_quantity; 
        $stmt = $pdo->prepare("UPDATE `cart` SET quantity = ?, price = ? WHERE user_id = ? AND product_id = ?;");
        $stmt->execute([$product_quantity, $product_price, $user_id, $product_id]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        $stmt = $pdo->prepare("INSERT INTO `cart`(`user_id`, `product_id`, `price`) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $product_id, $product_price]);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
