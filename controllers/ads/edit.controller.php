<?php
requireLogin();
$current_id = getIdFromQuery();

if (!($current_id > 0)) {
    http_response_code(404);
    exit;
}

$current_ad = $ad->get($current_id);
//dd($current_ad);

// TODO: Add view for case that ad is not found
if (!$current_ad) {
    http_response_code(404);
    exit;
}

$statement = $pdo->prepare("SELECT * FROM car_brands");
$statement->execute();
$brands = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ad->edit($current_ad, $current_id);

    header("Location: /ads/edit?id=$current_id");
    exit;
}

view('ads/edit.view', compact('current_ad', 'brands')); // 'images',