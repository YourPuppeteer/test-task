<?php
namespace Scandiweb\Controller\ProductController;
session_start();

require_once('../../vendor/autoload.php');

use Scandiweb\Database\Database;

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

        echo json_encode(array('message' => "success"));
        exit();
    }
}

