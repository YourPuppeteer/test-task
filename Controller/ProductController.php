<?php
namespace Controller;
require_once ('../vendor/autoload.php');

use PDO;
use src\Database;
use View;


class ProductController {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function deleteProducts($selectedProducts) {
        foreach ($selectedProducts as $product) {
            $skuValue = explode(' ', $product)[0];
            $skuValue = str_replace(' ', '', $skuValue);

            $stmt = $this->db->prepare('DELETE FROM products WHERE SKU = :sku');
            $stmt->bindValue(':sku', $skuValue);
            $stmt->execute();
        }

        header('Location: ../View/ProductList.php');
        exit();
    }
}

// Instantiate the product controller and call the deleteProducts method
$productController = new ProductController();
$productController->deleteProducts($_POST['selected_products']);


