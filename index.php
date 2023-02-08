<?php

require_once ('vendor/autoload.php');


use src\Database;


$db = Database::getInstance();
$conn = $db->getConnection();
$sql = "SELECT * FROM `products`";

$stmt = $conn->query($sql);
$rows = $stmt->fetchAll();


foreach ($rows as $row){
    echo "SKU : " . $row['sku'] . "<br>" . "name : " . $row["name"] . "<br>" . "price :" . $row['price'] . "<br>";
    echo "<br>";

}