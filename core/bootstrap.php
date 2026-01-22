<?php
// start session here
// define BASE_PATH constant
// connect db
// require utils
// require router

require_once '../models/Connection.php';
require_once '../models/QueryBuilder.php';
require_once '../models/User.php';
require_once '../models/Ad.php';
require_once '../models/CarBrands.php';
require_once '../models/CarModels.php';

session_start();

define('BASE_PATH', dirname(__DIR__) . '/');

$pdo = Connection::connect();
$user = new User($pdo);
$ad = new Ad($pdo);
$carBrands = new CarBrands($pdo);
$carModels = new CarModels($pdo);

require BASE_PATH . 'core/utils.php';
require base('router/index.php');
