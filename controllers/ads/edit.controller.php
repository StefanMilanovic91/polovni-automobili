<?php
requireLogin();
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
//dd($ad);

// TODO: Add view for case that ad is not found
if (!$ad) {
    http_response_code(404);
    exit;
}

$statement2 = $pdo->prepare("SELECT * FROM ad_images WHERE ad_id = :ad_id");
$statement2->execute(['ad_id' => $ad_id]);
$images = $statement2->fetchAll();

$statement = $pdo->prepare("SELECT * FROM car_brands");
$statement->execute();
$brands = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user']['id'];
    $brandId = empty($_POST['brand_id']) ? $ad->brand_id : (int)$_POST['brand_id'];
    $modelId = empty($_POST['model_id']) ? $ad->model_id : (int)$_POST['model_id'];
    $price = empty($_POST['price']) ? $ad->price : (int)$_POST['price'];
    $year = empty($_POST['year']) ? $ad->year : (int)$_POST['year'];
    $mileage = empty($_POST['mileage']) ? $ad->mileage : (int)$_POST['mileage'];
    $location = empty($_POST['location']) ? $ad->location : trim($_POST['location']);
    $description = empty($_POST['description']) ? $ad->description : trim($_POST['description']);

    $statement = $pdo->prepare('SELECT * FROM car_models WHERE id = :model_id AND brand_id = :brand_id');
    $statement->execute(['model_id' => $modelId, 'brand_id' => $brandId]);
    $model = $statement->fetchAll();

    $has_validation_error =
        count($model) !== 1 ||
        $price <= 0 ||
        $year < 1900 || $year > 2026 ||
        $mileage < 0 ||
        strlen($location) < 2 ||
        strlen($description) < 10;

    if (!$has_validation_error) {
        $statement = $pdo->prepare('UPDATE ads SET
                                                brand_id = :brand_id,
                                                model_id = :model_id,
                                                price = :price,
                                                year = :year,
                                                mileage = :mileage,
                                                location = :location,
                                                description = :description
                                            WHERE id = :ad_id AND user_id = :user_id
                                        ');
        $is_successful_update = $statement->execute([
            'brand_id' => $brandId,
            'model_id' => $modelId,
            'price' => $price,
            'year' => $year,
            'mileage' => $mileage,
            'location' => $location,
            'description' => $description,
            'ad_id' => $ad_id,
            'user_id' => $_SESSION['user']['id']
        ]);

        if ($is_successful_update) {
            $_SESSION['ad_id'] = $ad_id;
        }
    }

    header("Location: /ads/edit?id=$ad_id");
    exit;
}

view('ads/edit.view', compact('ad', 'images', 'brands'));