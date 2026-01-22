<?php

redirectIfNotLoggedIn();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['id'])) {
        echo json_encode(['success' => false, 'message' => "Invalid id"]);
    } else {
        $ad->delete($data['id']);

        if ($ad->is_ad_removed) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => "Oooops, something went wrong"]);
        }
    }
}

exit;