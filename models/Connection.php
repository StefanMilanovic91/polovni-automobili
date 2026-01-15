<?php

class Connection
{

    public static function connect()
    {
        try {
            return new PDO('mysql:host=localhost;dbname=polovni_automobili_db_v2', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (PDOException $e) {
            echo "DB EXCEPTION: " . $e->getMessage();
            exit;
        }
    }
}