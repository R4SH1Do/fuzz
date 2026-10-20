<div class="container align-items-center  min-vh-100">
    <h1 class="text-center m-3">Админ панель</h1>
    <div class="table-responsive">
        <table class="table">
            <thead class="rounded">
                <tr class="table-dark">
                    <th scope="col"><a href="admin.php?sort=id" class="text-white link-underline-light">№ Заказа</a></th>
                    <th scope="col"><a href="admin.php?sort=full_name" class="text-white link-underline-light">ФИО заказчика</a></th>
                    <th scope="col">Состав</th>
                    <th scope="col"><a href="admin.php?sort=date" class="text-white link-underline-light">Дата оформления</a></th>
                    <th scope="col"><a href="admin.php?sort=price" class="text-white link-underline-light">Стоимость</a></th>
                    <th scope="col"><a href="admin.php?sort=status" class="text-white link-underline-light">Статус</a></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'src/admin.php';
                foreach ($orders as $order_data):
                    $total_price = $order_data['total_price'];
                    $total_price = number_format($total_price, 0, '', ' ');
                ?>
                    <tr>
                        <form action="src/update-status.php" method="post">
                            <th scope="row"><?= $order_data['order_id'] ?></th>
                            <td><?= $order_data['full_name'] ?></td>
                            <td class="d-flex flex-column">
                                <?php
                                $stmt = $pdo->prepare("SELECT * FROM order_items INNER JOIN products ON order_items.product_id = products.product_id WHERE order_id = ?");
                                $stmt->execute([$order_data['order_id']]);
                                $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($order_items as $order_item): ?>
                                    <p><?= $order_item['name'] ?> (<?= $order_item['quantity'] ?> шт.)</p>
                                <?php endforeach ?>
                            </td>
                            <td><?= $order_data['creation_date'] ?></td>
                            <td><?= $total_price ?> ₽</td>
                            <td>
                                <select name="status" id="">
                                    <option value="<?= $statusNew_id ?>" <?= $order_data['status_id'] == $statusNew_id ? 'selected' : '' ?>><?= $statusNew ?></option>
                                    <option value="<?= $statusAppointed_id ?>" <?= $order_data['status_id'] == $statusAppointed_id ? 'selected' : '' ?>><?= $statusAppointed ?></option>
                                    <option value="<?= $statusDone_id ?>" <?= $order_data['status_id'] == $statusDone_id ? 'selected' : '' ?>><?= $statusDone ?></option>
                                </select>
                                <input type="hidden" value=<?= $order_data['order_id'] ?> name="order_id">
                            </td>
                            <td><button class="btn btn-dark" type="submit">Обновить</button></td>
                        </form>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>