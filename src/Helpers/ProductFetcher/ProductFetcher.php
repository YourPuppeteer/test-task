<?php

namespace Scandiweb\Helpers\ProductFetcher;

use PDO;
use Scandiweb\Database\Database;


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
            $class = "Scandiweb\\Product\\" . $classMap[$row['type']] . "\\" . $classMap[$row['type']];
            $product = new $class($row['sku'], $row['name'], $row['price'], $row['type_value']);

            $productInformation = $product->getProduct();
            $products[] = $productInformation;
        }

        return $products;
    }
}