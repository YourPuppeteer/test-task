<?php

namespace Controller;
session_start();

require_once('../vendor/autoload.php');

use PDO;
use Product\Validation\Validator;
use src\Database;
use View;




class FormController {


    private $db;
    private $validator;
    //private $errors;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->validator = new Validator();

    }

    public function addProduct($sku, $name, $price, $productType, $typeValue) {




        //Validation
        $validatedInputs = $this->validator->validate($sku, $name, $price, $productType, $typeValue);
        //

        var_dump($validatedInputs);

        if(is_string($validatedInputs)){
            echo $this->$validatedInputs;
            $_SESSION['form_errors'] = $validatedInputs;
            header('Location: ../View/ProductForm.php');
            exit();

        }






        // Insert to database
        $sql = "INSERT INTO products (SKU, Name, Price, Type, TypeValue) VALUES (:sku, :name, :price, :type, :typeValue)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sku', $validatedInputs['sku']);
        $stmt->bindParam(':name', $validatedInputs['name']);
        $stmt->bindParam(':price', $validatedInputs['price']);
        $stmt->bindParam(':type', $validatedInputs['productType']);
        $stmt->bindParam(':typeValue', $validatedInputs['typeValue']);
        $stmt->execute();



    }
}

// Create a new instance of the ProductController
$formController = new FormController();

// Call the addProduct method with the form inputs
$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$productType = $_POST['productType'];

$dimensionsMap = [
    'DVD' => $_POST['weight'] ?? '',
    'Book' => $_POST['size'] ?? '',
    'Furniture' => isset($_POST['height'], $_POST['width'], $_POST['length']) ? $_POST['height'] . 'x' . $_POST['width'] . 'x' . $_POST['length'] : '',
];

$typeValue = $dimensionsMap[$productType] ?? '';

$formController->addProduct($sku, $name, $price, $productType, $typeValue);



header('Location: ../View/ProductList.php');
exit();

