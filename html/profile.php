<h1 class="text-center my-3">Личный кабинет</h1>
<div class="row d-flex border-bottom pb-5 g-4">
    <div class="col-sm-12 col-md-6 d-flex justify-content-center align-items-center">
        <div class="rounded-circle bg-dark circle-profile ms-4 d-flex justify-content-center align-items-center"
            style="width: 180px; height: 180px;">
            <p class="text-light m-0 fs-1"><?= $_SESSION['login'][0] ?></p>
        </div>
    </div>
    <div class="justify-content-center col-sm-12 justify-content-left col-md-6 d-flex  align-items-center">
        <ul class="fs-5">
            <li>ФИО: <?= $_SESSION['full_name'] ?></li>
            <li>Логин: <?= $_SESSION['login'] ?></li>
            <li>Номер телефона: <?= $_SESSION['phone_number'] ?></li>
            <li>Адрес электронной почты: <?= $_SESSION['email'] ?></li>
        </ul>
    </div>
</div>
<h1 class="text-center mb-5">Заказы</h1>
<div class="container">
    <?php
        require_once 'src/db.php';
        $stmt = $pdo->prepare("SELECT order_id, creation_date, total_price, statuses.name FROM `orders` INNER JOIN statuses ON orders.status_id = statuses.status_id WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($orders as $order):
            $total_price = $order['total_price'];
            $total_price = number_format($total_price, 0, '', ' ');

    ?>
            <div class="card mb-4 border-0 rounded-0" style="background-color: #f0f0f0;">
                <div class="card-header p-3 d-flex justify-content-between align-items-center">
                    <p class="fs-5 fw-bolder">Заказ №<?= $order['order_id'] ?> от <?= $order['creation_date'] ?></p>
                    <div class="bg-dark rounded h-100 align-middle px-3">
                        <p class="fw-medium text-center text-light m-1"><?= $order['name'] ?></p>
                    </div>
                </div>
                <div class="card-body d-flex align-items-center">
                    <?php
                    $stmt = $pdo->prepare("SELECT image FROM `order_items` INNER JOIN `products` ON order_items.product_id = products.product_id WHERE order_id = ? ");
                    $stmt->execute([$order['order_id']]);
                    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($images as $image):?>
                        <img src="<?= $image['image']?>" class="m-3 img-shadow" alt="" width="75">
                     <?php endforeach ?>
                    <p class="ms-auto fs-4 fw-bolder"><?= $total_price ?> ₽</p>
                </div>
            </div>
    <?php endforeach ?>
    
</div>