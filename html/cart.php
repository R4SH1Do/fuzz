<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <?php
        require_once 'src/db.php';
        $stmt = $pdo->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        $products_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($products_id)):
        ?>
            <h1 class="text-center my-4">Корзина пуста</h1>
        <?php else: ?>
            <h1 class="text-center fs-2 my-4">Корзина</h1>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                <table>
                    <tbody>
                        <?php
                        require_once 'src/db.php';
                        $stmt = $pdo->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                        $stmt->execute([$_SESSION['user_id']]);
                        $products_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (empty($products_id)):
                        ?>
                            <h2 class="text-center">Корзина пуста</h2>
                            <?php else:
                            $total_price = 0;
                            $total_quantity = 0;
                            foreach ($products_id as $product_id):
                                $quantity = $product_id['quantity'];
                                $stmt = $pdo->prepare("SELECT * FROM `products` WHERE product_id = ?");
                                $stmt->execute([$product_id['product_id']]);
                                $product_info = $stmt->fetch(PDO::FETCH_ASSOC);
                                $_SESSION['total_price'] = $total_price += ($product_info['price'] * $quantity);
                                $total_quantity += $quantity;

                                $product_info['price'] = number_format($total_price, 0, '', ' ');
                            ?>

                                <tr class="border-bottom">
                                    <td class="p-2 pb-5">
                                        <div class="d-flex justify-content-center">
                                            <a href="">
                                                <img src="<?= $product_info['image'] ?>" width="70px" class="img-shadow">
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-2 py-5 w-50">
                                        <p class="fw-bolder">Электрогитара <?= $product_info['name'] ?></p>
                                        <ul class="text-secondary">
                                            <li style="font-size: 15px">
                                                Форма: <?= $product_info['shape'] ?>
                                            </li>
                                            <li style="font-size: 15px">
                                                Ладов: <?= $product_info['number_of_frets'] ?>
                                            </li>
                                            <li style="font-size: 15px">
                                                Конфигурация: <?= $product_info['pickup_configuration'] ?>
                                            </li>
                                            <li style="font-size: 15px">
                                                Мензура: <?= $product_info['scale_length'] ?>
                                            </li>
                                        </ul>
                                        <?php if ($quantity > 1): ?>
                                            <div class="border d-flex justify-content-between align-center p-1 rounded"
                                                style="width:100px">
                                                <a
                                                    href="src/decrease.php?id=<?= $product_info['product_id'] ?>"><img src="img/minus.svg"
                                                        class="my-auto ms-2" alt="" width="10" style="height: 10px;" disabled></a>
                                                <div class="fw-bolder fs-5"><?= $quantity ?></div>
                                                <a href="src/increase.php?id=<?= $product_info['product_id'] ?>"><img src="img/plus.svg"
                                                        class="my-auto me-2" alt="" width="10" style="height: 10px;"></a>
                                            </div>
                                        <?php else: ?>
                                            <div class="border d-flex justify-content-between align-center p-1 rounded"
                                                style="width:100px">
                                                <a class="link-disabled"
                                                    href="#"><img src="img/minus.svg"
                                                        class="my-auto ms-2" alt="" width="10" style="height: 10px;" disabled></a>
                                                <div class="fw-bolder fs-5"><?= $quantity ?></div>
                                                <a href="src/increase.php?id=<?= $product_info['product_id'] ?>"><img src="img/plus.svg"
                                                        class="my-auto me-2" alt="" width="10" style="height: 10px;"></a>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                    <td class="p-2 pb-5 ps-5">
                                        <p class="fw-bold fs-5"><?= $product_info['price'] ?> ₽</p>
                                        <a class="btn border mt-5" href="src/del-from-cart.php?id=<?= $product_info['product_id'] ?>">
                                            <div class=" d-flex justify-content-center ">
                                                <img src="img/trash.png" alt="" width="30px" style="height:30px;">
                                                <p class='my-auto'>Удалить</p>
                                            </div>

                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;
                            $total_price = number_format($total_price, 0, '', ' ');
                            ?>
                    </tbody>
                </table>
            </div>
        <?php endif ?>
        <div class="col-12 col-md-10 col-lg-4 col-xl-4 bg-white rounded p-3 border shadow mb-3 mx-auto" style="top: 100px; position: sticky; height: fit-content; z-index: 1000;">
            <h3>Сумма заказа</h3>
            <div class="d-flex justify-content-between border-bottom pb-1">
                <div>
                    <ul class="list-unstyled fs-5">
                        <li>
                            Товары (<?= $total_quantity ?>):
                        </li>
                        <li>
                            Скидка:
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="list-unstyled fs-5">
                        <li>
                            <b><?= $total_price ?> ₽</b>
                        </li>
                        <li>
                            <b>0 ₽</b>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="d-flex justify-content-between ">
                <p class="fw-bold fs-5">Итого:</p>
                <p class="fw-bold fs-5"><?= $total_price ?> ₽</p>
            </div>
            <a href="src/new-order.php" class="btn btn-dark w-100 rounded-pill">Оформить заказ</a>
        </div>
    <?php endif ?>
    </div>
</div>
</div>