<h1 class="text-center my-4">Каталог</h1>
<div class="row g-2">
    <?php require_once 'src/catalog.php';
    foreach ($products as $product):
        $price = $product['price'];
        $price = number_format($price, 0, '', ' ');
    ?>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card h-100 rounded-0 product-card border-0 product-card">
                <div class="d-flex justify-content-center align-items-center img-container">
                    <img alt="American Vintage II 1973 Stratocaster®" src="<?= $product['image'] ?>"
                        class="img-fluid product-img">
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="fs-5 fw-medium card-title h-100">Электрогитара <?= $product['name'] ?></p>
                    <p class="fs-4 fw-bold"><?= $price ?> ₽</p>
                    <?php if (!empty($_SESSION['user_id'])):
                        $stmt = $pdo->prepare('SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?');
                        $stmt->execute([$_SESSION['user_id'], $product['product_id']]);
                        $product_in_cart = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($product['product_id'] == $product_in_cart['product_id']):
                            if ($product_in_cart['quantity'] > 1): ?>
                                <div class="border border-2 border-black d-flex justify-content-between align-center p-1 rounded">
                                    <a href="src/decrease.php?id=<?= $product['product_id'] ?>"><img src="img/minus.svg"
                                            class="my-auto ms-2" alt="" width="30" style="height: 30px;" disabled></a>
                                    <div class="fw-bolder fs-5"><?= $product_in_cart['quantity'] ?></div>
                                    <a href="src/increase.php?id=<?= $product['product_id'] ?>"><img src="img/plus.svg"
                                            class="my-auto me-2" alt="" width="30" style="height: 30px;"></a>
                                </div>
                            <?php else: ?>
                                <div class="border border-2 border-black d-flex justify-content-between align-center p-1 rounded">
                                    <a class="link-disabled"
                                        href="#"><img src="img/minus.svg"
                                            class="my-auto ms-2" alt="" width="30" style="height: 30px;" disabled></a>
                                    <div class="fw-bolder fs-5"><?= $product_in_cart['quantity'] ?></div>
                                    <a href="src/increase.php?id=<?= $product['product_id'] ?>"><img src="img/plus.svg"
                                            class="my-auto me-2" alt="" width="30" style="height: 30px;"></a>
                                </div>
                            <?php endif ?>
                        <?php else: ?>
                            <a href="src/add-to-cart.php?product_id=<?= $product['product_id'] ?>"
                                class="btn btn-dark mt-auto fw-bold">Купить</a>
                        <?php endif ?>
                    <?php else: ?>
                        <a href="src/add-to-cart.php?product_id=<?= $product['product_id'] ?>"
                            class="btn btn-dark mt-auto fw-bold">Купить</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>