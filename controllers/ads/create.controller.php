<?php
requireLogin();

$brands = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $statement = $pdo->prepare("SELECT * FROM car_brands");
    $statement->execute();
    $brands = $statement->fetchAll();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ad->create();

    header('Location: /ads/create' . ($ad->has_validation_error ? '?hasValidationError=true' : ''));
    exit;
}

view('ads/create.view', compact('brands'));