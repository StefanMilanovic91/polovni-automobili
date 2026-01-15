<?php
// start session here
// define BASE_PATH constant
// connect db
// require utils
// require router

require_once '../models/Connection.php';
require_once '../models/QueryBuilder.php';
require_once '../models/User.php';

session_start();

define('BASE_PATH', dirname(__DIR__) . '/');

$pdo = Connection::connect();

require BASE_PATH . 'core/utils.php';
require base('router/index.php');
