<?php

requireLogin();
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
        echo json_encode(['success' => false, 'message' => "Invalid id"]);
    } else {
        $id = $data['id'];

        $statement = $pdo->prepare("DELETE FROM ads WHERE id = :id AND user_id = :user_id");
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

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => "Oooops, something went wrong"]);
        }
    }
}

exit;