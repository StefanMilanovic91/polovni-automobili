<?php

class User extends QueryBuilder
{
    public bool $has_validation_error = false;
    public bool $is_registered_successfully = false;

    public function login(): void
    {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 5) {
            $this->has_validation_error = true;

            return;
        }

        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if (!$user) {
            $this->has_validation_error = true;

            return;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = [
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'role' => $user->role,
            ];

            return;
        }

        $this->has_validation_error = true;
    }

    public function register(): void
    {
        $name = isset($_POST['name']) ? trim($_POST['name']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;

        if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 5) {
            $this->has_validation_error = true;

            return;
        }

        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if ($user) {
            $this->has_validation_error = true;

            return;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        $this->is_registered_successfully = $statement->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashed_password
        ]);
    }
}
