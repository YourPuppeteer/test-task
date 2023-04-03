<?php

namespace Scandiweb\Helpers\ProductSave;

use Scandiweb\Database\Database;

class ProductSave
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function saveProduct($sku, $name, $price, $product_type, $type_value)
    {
        $sql = "INSERT INTO products (sku, name, price, type, type_value) VALUES (:sku, :name, :price, :type, :type_value)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $product_type);
        $stmt->bindParam(':type_value', $type_value);
        return $stmt->execute();
    }
}