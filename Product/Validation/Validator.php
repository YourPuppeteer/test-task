<?php

namespace Product\Validation;

use PDO;
use src\Database;

class Validator
{
    private $errors = [];
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function validate($sku, $name, $price, $productType, $typeValue)
    {
        $this->validateSku($sku);
        $this->validateName($name);
        $this->validatePrice($price);
        $this->validateProductType($productType);
        $this->validateTypeValue($typeValue);

        //If $errors is not empty, return errors
        if (!empty($this->errors)) {
            return $this->errors;
        }
        return [];
    }

    private function validateSku($sku)
    {
        // Check if the SKU is not empty
        if (empty($sku)) {
            $this->errors['sku'] = "SKU should not be empty.";
        }

        // Check if the SKU already exists in the database
        $stmt = $this->db->prepare("SELECT * FROM products WHERE SKU = :sku");
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $this->errors['sku'] = "SKU must be unique.";
        }
    }

    private function validateName($name)
    {
        if (empty($name)) {
            $this->errors['name'] = "Name should not be empty";
        }
    }

    private function validatePrice($price)
    {
        $values = (float)$price;

        if (empty($values)){
            $this->errors['price'] = "Price should not be empty.";
            return;

        }

        if ($values <= 0) {
            $this->errors['price'] = 'Price must be a number.';
        }
    }

    private function validateProductType($productType)
    {
        $allowedProductTypes = ['DVD', 'Book', 'Furniture'];

        if (!in_array($productType, $allowedProductTypes)) {
            $this->errors['productType'] = "Product type should be DVD, Book or Furniture";
        }
    }

    private function validateTypeValue($typeValue)
    {
        $values = explode('x', $typeValue);

        foreach ($values as $value) {
            if(empty($value)){
                $this->errors['typeValue'] = 'TypeValue dimensions should not be empty.';
                return;
            }
            if ($value <= 0) {
                $this->errors['typeValue'] = 'TypeValue dimensions must be number.';

            }
        }
    }
}
