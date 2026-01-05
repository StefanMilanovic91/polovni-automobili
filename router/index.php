<?php


$routes = [
    '/' => 'controllers/home.controller.php',

    '/add-car' => 'controllers/add-car.controller.php', // TODO: Preimenuj u /ads/create
//  '/ads/show' => 'controllers/ads/show.controller.php',

    '/auth/register' => 'controllers/auth/register.controller.php',
    '/auth/login' => 'controllers/auth/login.controller.php',
    '/auth/logout' => 'controllers/auth/logout.controller.php',

    '/get-models' => 'controllers/get-models.controller.php' // TODO: Preimenuj u /models
];

$path = getPath();

if (isset($routes[$path])) {
    require base($routes[$path]);
} else {
    http_response_code(404);
    // TODO: Create controllers/NotFound.php
    // require base('');
}