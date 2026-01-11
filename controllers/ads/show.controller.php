<?php

$ad_id = getIdFromQuery();

if (!($ad_id > 0)) {
    http_response_code(404);
    exit;
}
// TODO: Add protection in case the ad is not found.

$statement1 = $pdo->prepare("SELECT ads.*, car_brands.name AS brand, car_models.name AS model, users.name AS owner
                                    FROM ads 
                                    JOIN car_brands ON ads.brand_id = car_brands.id 
                                    JOIN car_models ON ads.model_id = car_models.id 
                                    JOIN users ON ads.user_id = users.id  
                                    WHERE ads.id = :ad_id 
");
$statement1->execute(['ad_id' => $ad_id]);
$ad = $statement1->fetch();

// TODO: Add view for case that ad is not found
if (!$ad) {
    http_response_code(404);
    exit;
}

$statement2 = $pdo->prepare("SELECT * FROM ad_images WHERE ad_id = :ad_id");
$statement2->execute(['ad_id' => $ad_id]);
$images = $statement2->fetchAll();
//dd($images);

view('ads/show.view', compact('ad', 'images'));