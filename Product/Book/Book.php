<?php

namespace Product\Book;


use Product\Main\Product;

class Book extends Product{
    private $typeValue;



    public function __construct($sku, $name, $price, $typeValue)
    {
        parent::__construct($sku, $name, $price);
        $this->typeValue = $typeValue;
    }

    public function setTypeValue($typeValue)
    {
        $this->typeValue = $typeValue;
    }

    public function getTypeValue()
    {
        return $this->typeValue;
    }

    public function getProduct()
    {
        // TODO: Implement getProduct() method.
        return "SKU:" .  $this->getSKU() .  " Name: " . $this->getName() . " Price: " . $this->getPrice() . " Weight: ". $this->getTypeValue();
    }
}