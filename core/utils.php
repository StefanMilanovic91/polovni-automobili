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
    return isset($_SESSION['user']);
}

function redirectIfNotLoggedIn(): void
{
    if (isLoggedIn()) {
        return;
    }

    header('Location: /?dialog=login');
    exit;
}

function getIdFromQuery()
{
    return isset($_GET['id']) && !empty($_GET['id']) ? (int)$_GET['id'] : null;
}

// TODO: Rethink, maybe move the following func to the User class.
function getSessionUser()
{
    return empty($_SESSION['user']) ? null : $_SESSION['user'];
}