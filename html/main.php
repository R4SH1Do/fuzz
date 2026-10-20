<?php 
$isHtmx = isset($_SERVER['HTTP_HX_REQUEST']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?= filemtime('css/style.css') ?>">
    <title><?=$title?></title>
</head>
<body class="d-flex flex-column min-vh-100">
        <?php if (!$isHtmx): ?>
    <nav class="navbar navbar-expand-lg border-bottom shadow-sm border-body p-3 fs-4 sticky-top bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="homepage.php" hx-get="homepage.php" hx-target="main" hx-push-url="true" hx-swap="innerHTML swap:200ms"><img src="img/Logo_Fuzz.svg" alt="" width="80"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="catalog.php" hx-get="catalog.php" hx-target="main" hx-push-url="true" hx-swap="innerHTML swap:200ms">Каталог</a>
                    </li>
                </ul>
                <?php
                    if(isset($_SESSION['login'])):
                ?>
                    <a class="nav-link me-3" href="cart.php" hx-get="cart.php" hx-target="main" hx-push-url="true" hx-swap="innerHTML swap:200ms"><img src="img/cart.svg" alt="" width="30"></a>
                    <a href="profile.php" hx-get="profile.php" hx-target="main" hx-push-url="true" hx-swap="innerHTML swap:200ms" class="link-primary link-offset-2 link-underline link-underline-opacity-0 link-underline-opacity-100-hover me-3">
                        <img src="img/profile.svg" alt="" width="35">
                    </a>
                    <a href="src/logout.php"><img src="img/log-out.svg" alt="" width="30" ></a>
                <?php else: ?>
                    <a href="auth.php" class="btn btn-outline-dark me-3" hx-get="auth.php" hx-target="main" hx-push-url="true" hx-swap="innerHTML swap:200ms">Войти</a>
                    <a href="index.php" class="btn btn-outline-dark" hx-get="index.php" hx-target="main" hx-push-url="true" hx-swap="innerHTML swap:200ms">Зарегистрироваться</a>
                <?php endif; ?>

            </div>
        </div>
    </nav>
        <?php endif; ?>
    <main class="flex-grow-1">
            <?php require_once $content . '.php'; ?>
    </main> 
      <?php if (!$isHtmx): ?>
    <footer class="border-top shadow mt-auto p-3 d-flex justify-content-center">
        <a class="navbar-brand" href="homepage.php"><img src="img/Logo_Fuzz.svg" alt="" width="80"></a>
    </footer>
    <?php endif ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.9.10"></script>
</body>
</html>