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

$images = $ad->getImages($current_id);

view('ads/show.view', compact('current_ad', 'images'));