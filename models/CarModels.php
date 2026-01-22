<?php

class CarModels extends QueryBuilder
{
    public function findByBrandAndModel($brandId, $modelId): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM car_models WHERE id = :model_id AND brand_id = :brand_id');
        $statement->execute(['model_id' => $modelId, 'brand_id' => $brandId]);

        return $statement->fetchAll();
    }

    public function findByBrand($brandId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM car_models WHERE brand_id = :brand_id");
        $statement->execute(['brand_id' => $brandId]);

        return $statement->fetchAll();
    }
}