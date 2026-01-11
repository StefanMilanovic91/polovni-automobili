<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$password = isset($_POST['password']) ? trim($_POST['password']) : null;

$hasValidationError = false;

if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 5) {
    $hasValidationError = true;
}


if ($hasValidationError === false) {
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $statement->execute(['email' => $email]);
    $user = $statement->fetch();

    if ($user) {
        $hasValidationError = true;
    } else {
        // TODO: Don't add a plain password to the DB, add a hash of the password!!!!
        $statement = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $statement->execute(['name' => $name, 'email' => $email, 'password' => $password]);

        // TODO: Add successful registration param.
        header('Location: /?dialog=login');
        exit;
    }

}

if ($hasValidationError) {
    header('Location: /?dialog=register&hasValidationError=true');
    exit;
}

// TODO: Check from where user navigate and redirect there.
header('Location: /');
exit;