<?php
namespace Scandiweb\Controller\FormController;

use Scandiweb\Helpers\ProductSave\ProductSave;
use Scandiweb\Product\Validation\Validation;

class FormController
{
    private $validation;
    private $productSave;
    private $sku;
    private $name;
    private $price;
    private $productType;
    private $typeValue;

    public function __construct($postData)
    {
        $this->validation = new Validation();
        $this->productSave = new ProductSave();

        $this->sku = $postData['sku'];
        $this->name = $postData['name'];
        $this->price = $postData['price'];
        $this->productType = $postData['productType'];

        $dimensionsMap = [
            'DVD' => $postData['size'] ?? '',
            'Book' => $postData['weight'] ?? '',
            'Furniture' => isset($postData['height'], $postData['width'], $postData['length']) ? $postData['height'] . 'x' . $postData['width'] . 'x' . $postData['length'] : '',
        ];
        $this->typeValue = $dimensionsMap[$this->productType] ?? '';
    }

    public function addProduct()
    {
        //Validation
        $validatedInputs = $this->validation->validate(
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

        if ($this->productSave->saveProduct($this->sku, $this->name, $this->price, $this->productType, $this->typeValue)) {
            echo json_encode(array('message' => "success"));
            exit();
        }

        echo json_encode(array('message' => "failure"));
    }
}



