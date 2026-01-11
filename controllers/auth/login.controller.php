<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /');
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : null;
$password = isset($_POST['password']) ? trim($_POST['password']) : null;

$hasValidationError = false;

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 5) {
    $hasValidationError = true;
}

if ($hasValidationError === false) {
    // TODO: Add hashed password verification!!!!
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $statement->execute(['email' => $email, 'password' => $password]);
    $user = $statement->fetch();

    if ($user) {
        $_SESSION['user'] = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role,
        ];
    } else {
        $hasValidationError = true;
    }


}

if ($hasValidationError) {
    header('Location: /?dialog=login&hasValidationError=true');
    exit;
}

// TODO: Check from where user navigate and redirect there.
header('Location: /');
exit;