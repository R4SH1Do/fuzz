<?php
    session_start();
    require_once 'src/db.php';
    $stmt = $pdo->prepare("SELECT name FROM `products` WHERE product_id = ?");
    $stmt->execute([$_GET['id']]);
    $product_name = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $product_name['name'];
    $content = 'html/product';
    require_once __DIR__ . '/html/main.php';
?>  