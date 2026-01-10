<?php

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(["message" => "Unauthorized"]);

    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(["message" => "Method Not Allowed"]);

    exit;
}

if (!isset($_GET['brand_id']) || empty($_GET['brand_id'])) {
    http_response_code(400);
    echo json_encode(["message" => "Bad request"]);

    exit;
}


$statement = $pdo->prepare("SELECT * FROM car_models WHERE brand_id = :brand_id");
$statement->execute(['brand_id' => $_GET['brand_id']]);
$models = $statement->fetchAll();

echo json_encode($models);
exit;