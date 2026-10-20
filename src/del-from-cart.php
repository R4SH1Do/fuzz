<?php
    session_start();
    require_once 'db.php';
    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM `cart` WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    header('Location: ../cart.php');