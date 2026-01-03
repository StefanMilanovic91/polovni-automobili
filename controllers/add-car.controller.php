<?php
requireLogin();

$statement = $pdo->prepare("SELECT * FROM car_brands");
$statement->execute();
$brands = $statement->fetchAll();

view('add-car.view', compact('brands'));