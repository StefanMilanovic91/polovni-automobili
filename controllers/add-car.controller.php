<?php
requireLogin();

// THIS IS DONE - TODO: Slusaj na POST method, validiraj pristigle podatke i sacuvaj ih u DB.

// NOTE: Nastavi odavde...
// TODO: Proveri da li nesto puca ako posaljes nevalidne podatke sa client side-a
// + prikazi na client side-u da validacija nije prosla

// TODO: Kada sve prodje uspesno nekako prikazi success view i ponudi korisniku opcije:
// - da vidi dodati oglas - Prikazi Oglas btn
// - da se vrati na pocetnu str/sve oglase - ???
// - da ponovo prikaze formu za dodavanje oglasa - Postavi Oglas btn

// TODO: Napravi /ads/show?id={{adId}} page

$brands = [];
$has_validation_error = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $statement = $pdo->prepare("SELECT * FROM car_brands");
    $statement->execute();
    $brands = $statement->fetchAll();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user']['id'];
    $brandId = (int)$_POST['brand_id'];
    $modelId = (int)$_POST['model_id'];
    $price = (int)$_POST['price'];
    $year = (int)$_POST['year'];
    $mileage = (int)$_POST['mileage'];
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);

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
        empty($_FILES['images']) || empty($_FILES['images']['name'][0]) || count($_FILES['images']['name']) > 3;

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
            $upload_destination = base("uploads/ads/$ad_id/");
            $images = $_FILES['images'];
            $image_count = count($images['name']);

            if (!is_dir($upload_destination)) {
                mkdir($upload_destination, 0755, true);
            }

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
                }

            }
        }

        header('Location: /add-car');
        exit;
    }

}

view('add-car.view', compact('brands', 'has_validation_error'));