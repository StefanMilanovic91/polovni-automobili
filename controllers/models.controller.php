<?php

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

$models = $carModels->findByBrand($_GET['brand_id']);

echo json_encode($models);
exit;