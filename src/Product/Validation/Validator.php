<?php

namespace Scandiweb\Product\Validation;

use PDO;
use Scandiweb\Database\Database;

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

        if (empty($sku)) {
            $this->errors['sku'] = "Please, submit required data.";
        }
        if (strlen($sku) < 4 || strlen($sku) > 16) {
            $this->errors['sku'] = "SKU must be between 4 and 16 characters long.";
        }

        if (!preg_match('/^[a-zA-Z0-9-]+$/', $sku)) {
            $this->errors['sku'] = "SKU must contain only alphanumeric characters and dashes.";
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
            $this->errors['name'] = "Please, submit required data";
        }
    }

    private function validatePrice($price)
    {
        $values = (float)$price;

        if (empty($values)){
            $this->errors['price'] = "Please, submit required data.";
            return;

        }

        if ($values <= 0) {
            $this->errors['price'] = 'Please, provide the data of indicated type.';
        }
    }

    private function validateProductType($productType)
    {
        $allowedProductTypes = ['DVD', 'Book', 'Furniture'];

        if (!in_array($productType, $allowedProductTypes)) {
            $this->errors['productType'] = "Please, provide the data of indicated type";
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
                $this->errors['typeValue'] = 'Please, provide the data of indicated type.';

            }
        }
    }
}
