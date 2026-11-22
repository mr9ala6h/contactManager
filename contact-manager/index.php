<?php
declare(strict_types=1);

// Front controller: every request enters here and is routed to a controller action.
session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
session_start();

require __DIR__ . '/config/database.php';
require __DIR__ . '/core/helpers.php';
require __DIR__ . '/models/Contact.php';
require __DIR__ . '/models/User.php';
require __DIR__ . '/controllers/ContactController.php';
require __DIR__ . '/controllers/AuthController.php';

// Whitelist of routes: "METHOD route" => [Controller, action]
$routes = [
    'GET contacts/index'   => ['ContactController', 'index'],
    'GET contacts/create'  => ['ContactController', 'create'],
    'POST contacts/store'  => ['ContactController', 'store'],
    'GET contacts/edit'    => ['ContactController', 'edit'],
    'POST contacts/update' => ['ContactController', 'update'],
    'POST contacts/delete' => ['ContactController', 'delete'],
    'GET auth/login'       => ['AuthController', 'loginForm'],
    'POST auth/login'      => ['AuthController', 'login'],
    'POST auth/logout'     => ['AuthController', 'logout'],
];

$route = $_GET['r'] ?? 'contacts/index';
$key = $_SERVER['REQUEST_METHOD'] . ' ' . $route;

if (!isset($routes[$key])) {
    http_response_code(404);
    exit('Page not found.');
}

[$class, $action] = $routes[$key];
(new $class())->$action();
