<?php
namespace Product\Validation;


use Exception;
use PDO;
use src\Database;


class Validator {
    private $errors = [];
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function validate($sku, $name, $price, $productType, $typeValue) {
        $this->validateSku($sku);
        $this->validateName($name);
        $this->validatePrice($price);
        $this->validateProductType($productType);
        $this->validateTypeValue($typeValue);

        // Throw an exception if there are any errors
        if (!empty($this->errors)) {
            throw new Exception('Validation errors: ' . implode(', ', $this->errors));
        }

        // Return the validated inputs as an array
        return [
            'sku' => $sku,
            'name' => $name,
            'price' => $price,
            'productType' => $productType,
            'typeValue' => $typeValue
        ];
    }

    private function validateSku($sku) {
        // Check if the SKU is not empty
        if (empty($sku)) {
            $this->errors['sku'] = "SKU cannot be empty.";
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

    private function validateName($name) {
        if(empty($name)){
            $this->errors['name'] = "Name should not be empty";
        }
    }

    private function validatePrice($price) {

        if (!is_integer($price) || $price <= 0) {
            $this->errors['price'] = 'Price must be a number.';
            var_dump($price);
        }
    }

    private function validateProductType($productType) {
        $allowedProductTypes = ['DVD' , 'Book', 'Furniture'];

        if(!in_array($productType, $allowedProductTypes)){
            $this->errors['productType'] = "Product type should be DVD, Book or Furniture";
        }

    }

    private function validateTypeValue($typeValue) {

        if (!is_integer($typeValue) || $typeValue <= 0) {

        }
            $values = explode('x', $typeValue);

            foreach ($values as $value) {
                if (!is_integer($value) || $value <= 0) {
                    $this->errors['typeValue'] = 'TypeValue dimensions must be number.';

                }
            }
    }
}
