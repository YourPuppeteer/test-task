<?php

namespace Controller;

require_once('../vendor/autoload.php');

use PDO;
use src\Database;
use View;

$db = Database::getInstance();
$conn = $db->getConnection();


$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$productType = $_POST['productType'];
//$typeValue = "";


$dimensionsMap = [
    'DVD' => $_POST['weight'] ?? '',
    'Book' => $_POST['size'] ?? '',
    'Furniture' => $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'] ?? '',
];

$typeValue = $dimensionsMap[$productType] ?? '';

// echo the form inputs
/*echo "SKU: $sku<br>";
echo "Name: $name<br>";
echo "Price: $price<br>";
echo "Type: $productType<br>";
echo "Dimentions: $typeValue<br>";*/




// Insert to database

$sql = "INSERT INTO products (SKU, Name, Price, Type, TypeValue) VALUES (:sku, :name, :price, :type, :typeValue)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':sku', $sku);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':price', $price);
$stmt->bindParam(':type', $productType);
$stmt->bindParam(':typeValue', $typeValue);
$stmt->execute();


header('Location: ../View/ProductList.php');
exit();

