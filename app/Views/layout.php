<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) . ' - ' : '' ?><?= $_ENV['APP_NAME'] ?? 'Mon App' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1 class="h3 mb-0"><?= $_ENV['APP_NAME'] ?? 'Mon App' ?></h1>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
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