<?php

namespace Product\ProductFetcher;

use PDO;
use src\Database;


class ProductFetcher
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function fetchProducts()
    {
        $classMap = [
            'DVD' => 'DVD',
            'Book' => 'Book',
            'Furniture' => 'Furniture',
        ];

        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM `products`";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $class = "Product\\" . $classMap[$row['Type']] . "\\" . $classMap[$row['Type']];
            $product = new $class($row['SKU'], $row['Name'], $row['Price'], $row['TypeValue']);

            $productInformation = $product->getProduct();
            $products[] = $productInformation;
        }

        return $products;
    }
}