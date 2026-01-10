<?php
requireLogin();

$brands = [];
$has_validation_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $statement = $pdo->prepare("SELECT * FROM car_brands");
    $statement->execute();
    $brands = $statement->fetchAll();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user']['id'];
    $brandId = isset($_POST['brand_id']) ? (int)$_POST['brand_id'] : null;
    $modelId = isset($_POST['model_id']) ? (int)$_POST['model_id'] : null;
    $price = isset($_POST['price']) ? (int)$_POST['price'] : null;
    $year = isset($_POST['year']) ? (int)$_POST['year'] : null;
    $mileage = isset($_POST['mileage']) ? (int)$_POST['mileage'] : null;
    $location = isset($_POST['location']) ? trim($_POST['location']) : null;
    $description = isset($_POST['description']) ? trim($_POST['description']) : null;

    $statement = $pdo->prepare('SELECT * FROM car_models WHERE id = :model_id AND brand_id = :brand_id');
    $statement->execute(['model_id' => $modelId, 'brand_id' => $brandId]);
    $model = $statement->fetchAll();

    $has_validation_error =
        count($model) !== 1 ||
        $price <= 0 ||
        $year < 1900 || $year > 2026 ||
        $mileage < 0 ||
        strlen($location) < 2 ||
        strlen($description) < 10 ||
        empty($_FILES['images']) || empty($_FILES['images']['name'][0]) || count($_FILES['images']['name']) > 3 || count($_FILES['images']['name']) < 1;

    if (!$has_validation_error) {
        $statement = $pdo->prepare('INSERT INTO
                                    ads (user_id, brand_id, model_id, price, year, mileage, location, description)
                                    VALUES (:user_id, :brand_id, :model_id, :price, :year, :mileage, :location, :description)');
        $statement->execute([
            'user_id' => $userId,
            'brand_id' => $brandId,
            'model_id' => $modelId,
            'price' => $price,
            'year' => $year,
            'mileage' => $mileage,
            'location' => $location,
            'description' => $description
        ]);
        $ad_id = $pdo->lastInsertId();

        if ($ad_id) {
            $allowed_types = ['image/jpeg', 'image/png'];
            $upload_destination = base("public/uploads/ads/$ad_id/");
            $images = $_FILES['images'];
            $image_count = count($images['name']);

            if (!is_dir($upload_destination)) {
                mkdir($upload_destination, 0755, true);
            }
            terminal_var_dump($images);
            for ($i = 0; $i < $image_count; $i++) {
                if ($images['error'][$i] !== UPLOAD_ERR_OK) {
                    continue;
                }

                if (!in_array($images['type'][$i], $allowed_types)) {
                    continue;
                }

                $extension = pathinfo($images['name'][$i], PATHINFO_EXTENSION);
                $file_name = uniqid('img_', true) . '.' . $extension;

                $full_upload_destination = $upload_destination . $file_name;

                if (move_uploaded_file($images['tmp_name'][$i], $full_upload_destination)) {
                    $statement = $pdo->prepare("INSERT INTO ad_images (ad_id, path) VALUES (:ad_id, :path)");
                    $statement->execute([
                        'ad_id' => $ad_id,
                        'path' => 'uploads/ads/' . $ad_id . '/' . $file_name
                    ]);
                    $last_insert_into_ad_images = $pdo->lastInsertId();
                }

            }

            if ($last_insert_into_ad_images) {
                $_SESSION['ad_id'] = $ad_id;
            }
        }
    }

    header('Location: /ads/create' . ($has_validation_error ? '?hasValidationError=true' : ''));
    exit;
}

view('ads/create.view', compact('brands'));