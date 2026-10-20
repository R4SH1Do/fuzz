<div class="container d-flex align-items-center justify-content-center min-vh-100">

    <form class="w-50 vh-100 d-flex justify-content-center flex-column align-center" method="POST">
        <h1 class="text-center">Авторизация</h1>
        <?php foreach ($errors as $e): ?>
            <div class="w-75 mx-auto border border-danger bg-danger-subtle p-2 rounded">
                <p class="text-danger my-auto"><?= htmlspecialchars($e) ?></p>
            </div>
        <?php endforeach; ?>
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input type="text" class="form-control" name="login">
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-dark">Войти</button>
        <a class="m-3 link-dark" href="index.php">Ещё не зарегистрированны? Зарегистрироваться</a>
    </form>
</div>