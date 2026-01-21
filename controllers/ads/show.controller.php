<?php

$current_id = getIdFromQuery();

if (!($current_id > 0)) {
    http_response_code(404);
    exit;
}

$current_ad = $ad->get($current_id);

// TODO: Add view for case that ad is not found
if (!$current_ad) {
    http_response_code(404);
    exit;
}

$statement2 = $pdo->prepare("SELECT * FROM ad_images WHERE ad_id = :ad_id");
$statement2->execute(['ad_id' => $current_id]);
$images = $statement2->fetchAll();
//dd($images);

view('ads/show.view', compact('current_ad', 'images'));