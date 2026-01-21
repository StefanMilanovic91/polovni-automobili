<?php

use JetBrains\PhpStorm\NoReturn;

class Ad extends QueryBuilder
{
    public bool $has_validation_error = false;
    public bool $is_ad_removed = false;

    public function get($id)
    {
        $statement1 = $this->pdo->prepare("SELECT ads.*, car_brands.name AS brand, car_models.name AS model, users.name AS owner
                                    FROM ads 
                                    JOIN car_brands ON ads.brand_id = car_brands.id 
                                    JOIN car_models ON ads.model_id = car_models.id 
                                    JOIN users ON ads.user_id = users.id  
                                    WHERE ads.id = :id 
        ");
        $statement1->execute(['id' => $id]);

        return $statement1->fetch();
    }

    public function edit($current_ad, $current_ad_id): void
    {
        $brandId = empty($_POST['brand_id']) ? $current_ad->brand_id : (int)$_POST['brand_id'];
        $modelId = empty($_POST['model_id']) ? $current_ad->model_id : (int)$_POST['model_id'];
        $price = empty($_POST['price']) ? $current_ad->price : (int)$_POST['price'];
        $year = empty($_POST['year']) ? $current_ad->year : (int)$_POST['year'];
        $mileage = empty($_POST['mileage']) ? $current_ad->mileage : (int)$_POST['mileage'];
        $location = empty($_POST['location']) ? $current_ad->location : trim($_POST['location']);
        $description = empty($_POST['description']) ? $current_ad->description : trim($_POST['description']);

        $statement = $this->pdo->prepare('SELECT * FROM car_models WHERE id = :model_id AND brand_id = :brand_id');
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
            $statement = $this->pdo->prepare('UPDATE ads SET
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
                'ad_id' => $current_ad_id,
                'user_id' => $_SESSION['user']['id']
            ]);

            if ($is_successful_update) {
                $_SESSION['ad_id'] = $current_ad_id;
            }
        }
    }

    public function delete(string $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM ads WHERE id = :id AND user_id = :user_id");
        $is_removed = $statement->execute([
            'id' => $id,
            'user_id' => $_SESSION['user']['id']
        ]);

        if ($is_removed) {
            $upload_destination = base("public/uploads/ads/$id");

            if (is_dir($upload_destination)) {
                foreach (glob($upload_destination . '/*') as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }

                rmdir($upload_destination);
            }

            $this->is_ad_removed = $is_removed;
        }
    }

    public function create(): void
    {
        $userId = $_SESSION['user']['id'];
        $brandId = isset($_POST['brand_id']) ? (int)$_POST['brand_id'] : null;
        $modelId = isset($_POST['model_id']) ? (int)$_POST['model_id'] : null;
        $price = isset($_POST['price']) ? (int)$_POST['price'] : null;
        $year = isset($_POST['year']) ? (int)$_POST['year'] : null;
        $mileage = isset($_POST['mileage']) ? (int)$_POST['mileage'] : null;
        $location = isset($_POST['location']) ? trim($_POST['location']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;

        $statement1 = $this->pdo->prepare('SELECT * FROM car_models WHERE id = :model_id AND brand_id = :brand_id');
        $statement1->execute(['model_id' => $modelId, 'brand_id' => $brandId]);
        $model = $statement1->fetchAll();

        $this->has_validation_error =
            count($model) !== 1 ||
            $price <= 0 ||
            $year < 1900 || $year > 2026 ||
            $mileage < 0 ||
            strlen($location) < 2 ||
            strlen($description) < 10 ||
            empty($_FILES['images']) || empty($_FILES['images']['name'][0]) || count($_FILES['images']['name']) > 3 || count($_FILES['images']['name']) < 1;

        if ($this->has_validation_error === false) {
            $statement2 = $this->pdo->prepare('INSERT INTO
                                    ads (user_id, brand_id, model_id, price, year, mileage, location, description)
                                    VALUES (:user_id, :brand_id, :model_id,  :price, :year, :mileage, :location, :description)');
            $statement2->execute([
                'user_id' => $userId,
                'brand_id' => $brandId,
                'model_id' => $modelId,
                'price' => $price,
                'year' => $year,
                'mileage' => $mileage,
                'location' => $location,
                'description' => $description
            ]);
            $ad_id = $this->pdo->lastInsertId();

            if (!$ad_id) {
                $this->has_validation_error = true;

                return;
            }

            $allowed_types = ['image/jpeg', 'image/png'];
            $upload_destination = base("public/uploads/ads/$ad_id/");
            $images = $_FILES['images'];
            $image_count = count($images['name']);

            if (!is_dir($upload_destination)) {
                mkdir($upload_destination, 0755, true);
            }

            $thumbnail = null;
            $last_insert_into_ad_images = null;

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
                    $path = 'uploads/ads/' . $ad_id . '/' . $file_name;

                    $statement3 = $this->pdo->prepare("INSERT INTO ad_images (ad_id, path) VALUES (:ad_id, :path)");
                    $statement3->execute([
                        'ad_id' => $ad_id,
                        'path' => $path
                    ]);
                    $last_insert_into_ad_images = $this->pdo->lastInsertId();

                    if (!$thumbnail) {
                        $thumbnail = $path;
                    }
                }

            }

            if ($thumbnail) {
                $statement4 = $this->pdo->prepare("UPDATE ads SET thumbnail = :thumbnail WHERE id = :ad_id");
                $statement4->execute(['thumbnail' => $thumbnail, 'ad_id' => $ad_id]);
            }

            if ($last_insert_into_ad_images) {
                $_SESSION['ad_id'] = $ad_id;
            }
        }
    }
}