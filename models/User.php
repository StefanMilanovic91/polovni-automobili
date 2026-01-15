<?php

class User extends QueryBuilder
{
    public bool $has_validation_error = false;
    public bool $is_registered_successfully = false;

//    function login() {
//
//    }

    public function register(): void
    {
        $values = $this->getValidatedRegisterValues();

        if (!$values) {
            return;
        }

        $values['password'] = password_hash($values['password'], PASSWORD_DEFAULT);
        $statement = $this->pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        $this->is_registered_successfully = $statement->execute($values);
    }

    private function getValidatedRegisterValues(): null|array
    {
        $name = isset($_POST['name']) ? trim($_POST['name']) : null;
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;

        if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 5) {
            $this->has_validation_error = true;

            return null;
        }

        $statement = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if ($user) {
            $this->has_validation_error = true;

            return null;
        }

        return [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ];
    }
}