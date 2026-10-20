<?php
require_once 'db.php';
$new_status = $_POST['status'];
$order_id = $_POST['order_id'];
$stmt = $pdo->prepare("UPDATE orders SET status_id = ? WHERE order_id = ?");
$stmt->execute([$new_status, $order_id]);
header('Location: ../admin.php');
exit;
