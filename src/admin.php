<?php
require_once 'src/db.php';
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case "id":
            $request = "SELECT * FROM orders
                INNER JOIN users ON orders.user_id = users.user_id
                INNER JOIN statuses ON orders.status_id = statuses.status_id
                ORDER BY orders.order_id";
            break;
        case 'full_name':
            $request = "SELECT * FROM orders
                INNER JOIN users ON orders.user_id = users.user_id
                INNER JOIN statuses ON orders.status_id = statuses.status_id
                ORDER BY full_name";
            break;
        case 'date':
            $request = "SELECT * FROM orders
                INNER JOIN users ON orders.user_id = users.user_id
                INNER JOIN statuses ON orders.status_id = statuses.status_id
                ORDER BY creation_date";
            break;
        case 'price':
            $request = "SELECT * FROM orders
                INNER JOIN users ON orders.user_id = users.user_id
                INNER JOIN statuses ON orders.status_id = statuses.status_id
                ORDER BY total_price";
            break;
        case 'status':
            $request = "SELECT * FROM orders
                INNER JOIN users ON orders.user_id = users.user_id
                INNER JOIN statuses ON orders.status_id = statuses.status_id
                ORDER BY statuses.status_id";
            break;
    }
} else {
    $request = "SELECT * FROM orders
            INNER JOIN users ON orders.user_id = users.user_id
            INNER JOIN statuses ON orders.status_id = statuses.status_id";
}
$stmt = $pdo->prepare($request);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM statuses");
$stmt->execute();
$statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
$statusNew = $statuses[0]['name'];
$statusNew_id = $statuses[0]['status_id'];
$statusAppointed = $statuses[1]['name'];
$statusAppointed_id = $statuses[1]['status_id'];
$statusDone = $statuses[2]['name'];
$statusDone_id = $statuses[2]['status_id'];
