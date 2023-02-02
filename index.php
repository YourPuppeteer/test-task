<?php


require_once 'autoload/autoloader.php';

$db = Database::getInstance();
$conn = $db->getConnection();
$sql = "SELECT * FROM `products`";

$stmt = $conn->query($sql);
$rows = $stmt->fetchAll();


foreach ($rows as $row){
    echo "SKU : " . $row['SKU'] . "<br>" . "name : " . $row["name"] . "<br>" . "price :" . $row['price'] . "<br>";
    echo "<br>";

}