<?php
require_once('src/db.php');
$stmt = $pdo->prepare('SELECT * FROM `products`');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);