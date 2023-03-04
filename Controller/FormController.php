<?php
namespace Controller;

require_once('../vendor/autoload.php');

use PDO;
use Product\Validation\Validator;
use Product\ProductSave\ProductSave;
use src\Database;
use View;

class FormController
{
    private $db;
    private $validator;
    private $productSave;
    private $sku;
    private $name;
    private $price;
    private $productType;
    private $typeValue;

    public function __construct($sku, $name, $price, $productType, $typeValue)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->validator = new Validator();
        $this->productSave = new ProductSave();

        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->productType = $productType;
        $this->typeValue = $typeValue;
    }

    public function addProduct()
    {
        //Validation
        $validatedInputs = $this->validator->validate(
            $this->sku,
            $this->name,
            $this->price,
            $this->productType,
            $this->typeValue
        );

        if (!empty($validatedInputs)) {
            //echo errors array
            $response = array('message' => $validatedInputs);
            echo json_encode($response);
            exit();
        }

        // Insert to database if no errors found

        if ($this->productSave->saveProduct($this->sku, $this->name, $this->price, $this->productType, $this->typeValue)) {
            echo json_encode(array('message' => "success"));
            exit();
        }

        echo json_encode(array('message' => "failure"));
    }
}

$postData = $_POST;

$addProductController = new AddProductController($postData);
$addProductController->handleFormSubmission();


