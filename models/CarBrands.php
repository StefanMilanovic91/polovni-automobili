<?php

class CarBrands extends QueryBuilder
{
    public function getBrands(): array
    {
        $statement2 = $this->pdo->query("SELECT * FROM car_brands");

        return $statement2->fetchAll();
    }
}