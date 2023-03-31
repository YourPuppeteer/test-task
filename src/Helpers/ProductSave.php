<?php

namespace Scandiweb\Helpers;

use Scandiweb\Database\Database;

class ProductSave
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function saveProduct($sku, $name, $price, $productType, $typeValue)
    {
        $sql = "INSERT INTO products (SKU, Name, Price, Type, TypeValue) VALUES (:sku, :name, :price, :type, :typeValue)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $productType);
        $stmt->bindParam(':typeValue', $typeValue);
        return $stmt->execute();
    }
}