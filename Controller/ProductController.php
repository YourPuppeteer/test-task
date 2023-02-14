<?php
namespace Controller;
require_once ('../vendor/autoload.php');

use PDO;
use src\Database;
use View;


$db = Database::getInstance();
$conn = $db->getConnection();

if (isset($_POST['selected_products'])) {
    foreach ($_POST['selected_products'] as $product) {
        $skuValue = explode(' ', $product)[0];
        $skuValue = str_replace(' ', '', $skuValue);

        $stmt = $conn->prepare('DELETE FROM products WHERE SKU = :sku');
        $stmt->bindValue(':sku', $skuValue);
        $stmt->execute();
    }
    header('Location: ../View/product.php');
    exit();
}
else{
    header('Location: ../View/product.php');
    exit();
}



