<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <form class="w-50 min-vh-100 d-flex justify-content-center flex-column align-center" method="POST">
        <h1 class="text-center mb-2">Регистрация</h1>
        <?php if(!empty($errors)): 
            foreach ($errors as $e): 
        ?>
            <div class="w-75 mx-auto border border-danger bg-danger-subtle p-2 rounded">
                <p class="text-danger my-auto"><?= htmlspecialchars($e) ?></p>
            </div>
        <?php 
            endforeach;
            endif
        ?>
        <div class="mb-3">
            <label class="form-label">Логин</label>
            <input type="text" class="form-control" name="login" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">ФИО</label>
            <input type="text" class="form-control" name="full_name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Телефон</label>
            <input type="text" class="form-control" name="phone_number" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Адрес электронной почты</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <button type="submit" class="btn btn-dark">Создать пользователя</button>
        <a class="m-3 link-dark" href="auth.php">Уже зарегистрированны? Авторизация</a>
    </form>
</div>