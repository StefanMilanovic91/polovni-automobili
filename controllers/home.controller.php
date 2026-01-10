<?php

// TODO: Add pagination.
// TODO: Add search.
$statement1 = $pdo->prepare("
                                SELECT ads.*, users.name AS owner, car_brands.name AS brand, car_models.name AS model, MIN(ad_images.path) AS thumbnail
                                FROM ads
                                JOIN users ON ads.user_id = users.id 
                                JOIN car_brands ON car_brands.id = ads.brand_id 
                                JOIN car_models ON car_models.id = ads.model_id 
                                LEFT JOIN ad_images ON ad_images.ad_id = ads.id 
                                GROUP BY ads.id
                            ");
$statement1->execute();
$ads = $statement1->fetchAll();
//dd($ads);

//$statement2 = $pdo->prepare('SELECT ad_id, MIN(path) AS thumbnail
//                            FROM ad_images
//                            GROUP BY ad_id');
//$statement2->execute();
//$ad_images = $statement2->fetchAll();
////dd($ad_images);

//$thumbnails = [];

//if ($ad_images) {
//    foreach ($ad_images as $img) {
//        if (isset($thumbnails[$img->ad_id])) {
//            continue;
//        } else {
//            $thumbnails[$img->ad_id] = $img->path;
//        }
//    }
//}
////dd($thumbnails);
//
//if ($ads) {
//    foreach ($ads as $ad) {
//        if (isset($thumbnails[$ad->id])) {
//            $ad->thumbnail = isset($thumbnails[$ad->id]) ? $thumbnails[$ad->id] : null;
//        }
//    }
//}

view('home.view', compact('ads'));