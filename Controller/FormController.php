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
    private $sku;
    private $name;
    private $price;
    private $productType;
    private $typeValue;

    public function __construct($sku, $name, $price, $productType, $typeValue) {
        $this->db = Database::getInstance()->getConnection();
        $this->validator = new Validator();

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
        $this->typeValue = $typeValue;



    }

    public function addProduct() {


        //Validation
        $validatedInputs = $this->validator->validate($this->sku, $this->name, $this->price, $this->productType, $this->typeValue);
        //
        //var_dump($validatedInputs);
        //var_dump($this->sku, $this->name, $this->price, $this->productType, $this->typeValue);
        //var_dump($validatedInputs);
        if(!empty($validatedInputs)){
            //var_dump($validatedInputs);
            //echo $this->$validatedInputs;
            //$_SESSION['form_errors'] = $validatedInputs;
            //header('Location: ../View/ProductForm.php');
            //exit();

            $response = array('message' => $validatedInputs);
            echo json_encode($response);
            exit();
        }

        // Insert to database
        if($this->saveProduct()){
          echo json_encode(array('message' => "success"));
          exit();
        }

        echo json_encode(array('message' => "failure"));
    }

    public function saveProduct(){
        $sql = "INSERT INTO products (SKU, Name, Price, Type, TypeValue) VALUES (:sku, :name, :price, :type, :typeValue)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':type', $this->productType);
        $stmt->bindParam(':typeValue', $this->typeValue);
        return $stmt->execute();



    }
}



// Create a new instance of the ProductController
//$formController = new FormController();

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

$formController = new FormController($sku, $name, $price, $productType, $typeValue);

$formController->addProduct();



/*header('Location: ../View/ProductList.php');
exit();*/

