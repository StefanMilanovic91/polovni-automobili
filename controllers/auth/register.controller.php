<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$user->register();

if ($user->has_validation_error) {
    header('Location: /?dialog=register&hasValidationError=true');
    exit;
}

if ($user->is_registered_successfully) {
    header('Location: /?dialog=login&isRegisteredSuccessfully=true');
    exit;
}

header('Location: /');
exit;
