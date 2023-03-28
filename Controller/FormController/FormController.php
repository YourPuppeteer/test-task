<?php
namespace Controller\FormController;

require_once('../vendor/autoload.php');

use Helpers\ProductSave;
use Product\Validation\Validator;

class FormController
{
    private $validator;
    private $productSave;
    private $sku;
    private $name;
    private $price;
    private $productType;
    private $typeValue;

    public function __construct($postData)
    {
        $this->validator = new Validator();
        $this->productSave = new ProductSave();

        $this->sku = $postData['sku'];
        $this->name = $postData['name'];
        $this->price = $postData['price'];
        $this->productType = $postData['productType'];

        $dimensionsMap = [
            'DVD' => $postData['weight'] ?? '',
            'Book' => $postData['size'] ?? '',
            'Furniture' => isset($postData['height'], $postData['width'], $postData['length']) ? $postData['height'] . 'x' . $postData['width'] . 'x' . $postData['length'] : '',
        ];
        $this->typeValue = $dimensionsMap[$this->productType] ?? '';
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



