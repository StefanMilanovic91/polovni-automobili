<?php

redirectIfNotLoggedIn();

$brands = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $brands = $carBrands->getBrands();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ad->create();

    header('Location: /ads/create' . ($ad->has_validation_error ? '?hasValidationError=true' : ''));
    exit;
}

view('ads/create.view', compact('brands'));