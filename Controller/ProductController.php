<?php
namespace Controller;
session_start();

require_once('../vendor/autoload.php');

use src\Database;
class ProductController
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function deleteProducts($selectedProducts)
    {
        foreach ($selectedProducts as $product) {
            $skuValue = explode(' ', $product)[0];
            $skuValue = str_replace(' ', '', $skuValue);

            $stmt = $this->db->prepare('DELETE FROM products WHERE SKU = :sku');
            $stmt->bindValue(':sku', $skuValue);
            $stmt->execute();
        }


       /* header('Location:' . $_SESSION['url']);
        exit();*/
        echo json_encode(array('message' => "success"));
        exit();
    }
}

// Instantiate the product controller and call the deleteProducts method
$productController = new ProductController();
$productController->deleteProducts($_POST['selected_products']);


