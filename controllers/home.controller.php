<?php

$brandId = empty($_GET['brand_id']) ? null : $_GET['brand_id'];
$modelId = empty($_GET['model_id']) ? null : $_GET['model_id'];
$priceFrom = empty($_GET['price_from']) ? null : $_GET['price_from'];
$priceTo = empty($_GET['price_to']) ? null : $_GET['price_to'];

// TODO: Add pagination.
$ads = $ad->searchAds($brandId, $modelId, $priceFrom, $priceTo);
$brands = $carBrands->getBrands();

$css_file_name = 'home.css';

view('home.view', compact('ads', 'brands', 'css_file_name'));