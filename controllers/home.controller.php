<?php
// TODO: Add pagination.

$brandId = empty($_GET['brand_id']) ? null : $_GET['brand_id'];
$modelId = empty($_GET['model_id']) ? null : $_GET['model_id'];
$priceFrom = empty($_GET['price_from']) ? null : $_GET['price_from'];
$priceTo = empty($_GET['price_to']) ? null : $_GET['price_to'];

$query = "SELECT ads.*, 
               users.name AS owner, 
               car_brands.name AS brand, 
               car_models.name AS model, 
               ad_images.path AS thumbnail 
            FROM ads 
            JOIN users ON ads.user_id = users.id 
            JOIN car_brands ON car_brands.id = ads.brand_id 
            JOIN car_models ON car_models.id = ads.model_id 
            JOIN ad_images ON ad_images.id = ads.image_id 
            WHERE 1";
$params = [];

if ($brandId) {
    $query .= " AND ads.brand_id = :brand_id";
    $params["brand_id"] = $brandId;
}
if ($modelId) {
    $query .= " AND ads.model_id = :model_id";
    $params["model_id"] = $modelId;
}
if ($priceFrom) {
    $query .= " AND ads.price >= :price_from";
    $params["price_from"] = $priceFrom;
}
if ($priceTo) {
    $query .= " AND ads.price <= :price_to";
    $params["price_to"] = $priceTo;
}
//dd($params);
//dd($query);

$statement1 = $pdo->prepare($query);
$statement1->execute($params);
$ads = $statement1->fetchAll();
//dd($ads);

$statement2 = $pdo->prepare("SELECT * FROM car_brands");
$statement2->execute();
$brands = $statement2->fetchAll();

$css_file_name = 'home.css';

view('home.view', compact('ads', 'brands', 'css_file_name'));