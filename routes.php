<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Core\Router;

$router = new Router();

$router->get('/', function () {
    $content = "<h1>Bienvenue dans ".$_ENV['APP_NAME'] ?? 'Mon App'." !</h1>";
    $content .= "<p>Le framework fonctionne correctement.</p>";
    require_once __DIR__ . '/app/Views/layout.php';
});

$router->get('inscription', function () {
    $authController = new AuthController();
    $authController->showRegisterForm();
});

$router->post('register', fn() => (new AuthController())->register());

$router->get('connexion', fn() => (new AuthController())->showLoginForm());

$router->post('login', fn() => (new AuthController())->login());
$router->get('logout', fn() => (new AuthController())->logout());

$router->get('dashboard', fn() => (new DashboardController())->index());


$router->get('test', function () {
   phpinfo();
});

$router->dispatch();