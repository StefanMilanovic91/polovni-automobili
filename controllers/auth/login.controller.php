<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$user->login();

if ($user->has_validation_error) {
    header('Location: /?dialog=login&hasValidationError=true');
    exit;
}

// TODO: Check from where user navigate and redirect there.
header('Location: /');
exit;
