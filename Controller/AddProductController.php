<?php
namespace Controller;
class AddProductController
{
    private $sku;
    private $name;
    private $price;
    private $productType;
    private $typeValue;

    public function __construct($postData){

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

    public function handleFormSubmission(){
        $handleForm = new FormController($this->sku, $this->name,$this->price,$this->productType,$this->typeValue);
        $handleForm->addProduct();
    }
}

