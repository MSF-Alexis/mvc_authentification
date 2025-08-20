<?php 
use App\Core\Router;

$router = new Router();

$router->get('/', function () {
    $content = "<h1>Bienvenue dans ".$_ENV['APP_NAME'] ?? 'Mon App'." !</h1>";
    $content .= "<p>Le framework fonctionne correctement.</p>";
    require_once __DIR__ . '/app/Views/layout.php';
});

$router->get('test', function () {
    echo "<h1>Page de test</h1>";
    echo "<p>URL propre fonctionnelle !</p>";
});

$router->dispatch();