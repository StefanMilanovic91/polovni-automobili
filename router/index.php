<?php


$routes = [
    '/' => 'controllers/Home.php',
];

$path = getPath();

if (isset($routes[$path])) {
    require base($routes[$path]);
} else {
    http_response_code(404);
    // TODO: Create controllers/NotFound.php
    // require base('');
}