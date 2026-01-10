<?php


$routes = [
    '/' => 'controllers/home.controller.php',

    '/ads/create' => 'controllers/ads/create.controller.php', // TODO: Mozda submit moze da salje na /ads/store - POST
    '/ads/show' => 'controllers/ads/show.controller.php',
    '/ads/edit' => 'controllers/ads/edit.controller.php',
    '/ads/delete' => 'controllers/ads/delete.controller.php',

    '/auth/register' => 'controllers/auth/register.controller.php',
    '/auth/login' => 'controllers/auth/login.controller.php',
    '/auth/logout' => 'controllers/auth/logout.controller.php',

    '/models' => 'controllers/models.controller.php'
];

$path = getPath();

if (isset($routes[$path])) {
    require base($routes[$path]);
} else {
    require base('controllers/not-found.controller.php');
}