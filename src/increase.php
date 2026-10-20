<?php
    session_start();
    require_once 'db.php';
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT quantity FROM `cart` WHERE user_id = ? and product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $quantity = $stmt->fetch(PDO::FETCH_ASSOC);
    $quantity['quantity']++;
    $stmt = $pdo->prepare("UPDATE `cart` SET quantity = ?  WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$quantity['quantity'] ,$user_id, $product_id]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;