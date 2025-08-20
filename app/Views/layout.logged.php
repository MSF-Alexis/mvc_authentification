<!-- File : views/layouts/user.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <title><?= isset($title) ? htmlspecialchars($title) . ' - ' : '' ?><?= $_ENV['APP_NAME'] ?? 'Mon App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="bg-primary text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0"><?= $_ENV['APP_NAME'] ?? 'Mon App' ?></h1>
            <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
            <?php if (isset($_SESSION['user'])): ?>
                <div>
                    Bonjour, <strong><?= htmlspecialchars($_SESSION['user']['name'], ENT_QUOTES) ?></strong>
                    &nbsp;|&nbsp;
                    <a href="/logout" class="text-white text-decoration-none">Déconnexion</a>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <nav class="navbar-expand navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav gap-3 d-flex">
            </ul>
        </div>
    </nav>

    <div class="container my-4 flex-fill">
        <div class="card">
            <div class="card-body">
                <?= $content ?>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; <?= $_ENV['APP_NAME'] ?? 'Mon App' ?></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
