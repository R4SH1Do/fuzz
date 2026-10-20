<?php
    session_start();
    require_once 'db.php';
    $user_id = $_SESSION['user_id'];
    $current_date = date('Y-m-d');

    $stmt = $pdo->prepare("SELECT SUM(price) AS 'total_price' FROM cart WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $total_price = $stmt->fetch(PDO::FETCH_ASSOC);

    $total_price = $total_price['total_price'];

    $stmt = $pdo->prepare("INSERT INTO `orders`(`user_id`, `creation_date`, `total_price`) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $current_date, $total_price]);

    $stmt = $pdo->prepare("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");
    $stmt->execute();
    $order_id = $stmt->fetch(PDO::FETCH_ASSOC);
    $order_id = $order_id['order_id'];
    $stmt = $pdo->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $products_in_cart = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($products_in_cart as $product_in_cart){
        $stmt = $pdo->prepare("INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $product_in_cart['product_id'], $product_in_cart['quantity'], $product_in_cart['price']]);

        $stmt = $pdo->prepare("DELETE FROM `cart` WHERE product_id = ? AND user_id = ?");
        $stmt->execute([$product_in_cart['product_id'], $user_id]);
    }
    header ('Location: ../profile.php');
    exit;




