<?php


$routes = [
    '/' => 'controllers/home.controller.php',
    '/auth/register' => 'controllers/auth/register.controller.php',
    '/auth/login' => 'controllers/auth/login.controller.php',
    '/auth/logout' => 'controllers/auth/logout.controller.php'
];

$path = getPath();

if (isset($routes[$path])) {
    require base($routes[$path]);
} else {
    http_response_code(404);
    // TODO: Create controllers/NotFound.php
    // require base('');
}