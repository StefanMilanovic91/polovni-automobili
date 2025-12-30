<?php

function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function terminal_var_dump($value)
{
    ob_start();
    var_dump($value);
    error_log(ob_get_clean());
}

function terminal_echo($message)
{
    ob_start();
    echo($message);
    error_log(ob_get_clean());
}

function base($path)
{
    return BASE_PATH . $path;
}


function view($path, $data = [])
{
    extract($data);
    require base("views/$path.php");
}

function getPath()
{
    return parse_url($_SERVER['REQUEST_URI'])['path'];
}

function isLoggedIn()
{
    return isset($_SESSION['user']['id'], $_SESSION['user']['name']);
}