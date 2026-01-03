<?php
// start session here
// define BASE_PATH constant
// connect db
// require utils'
// require router

session_start();

define('BASE_PATH', dirname(__DIR__) . '/');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=polovni_automobili_db", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]);
} catch (PDOException $e) {
    echo "DB_EXCEPTION: " . $e->getMessage();
    exit();
}

require BASE_PATH . 'core/utils.php';
require base('router/index.php');
