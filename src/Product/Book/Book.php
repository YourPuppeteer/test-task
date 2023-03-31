<?php

namespace Scandiweb\Product\Book;

use Scandiweb\Product\Main\Product;

class Book extends Product
{
    private $typeValue;

    public function __construct($sku, $name, $price, $typeValue)
    {
        parent::__construct($sku, $name, $price);
        $this->typeValue = $typeValue;
    }

    public function getProduct()
    {
        // TODO: Implement getProduct() method.
        return "SKU:" . $this->getSKU() . " /" . $this->getName() . "/" . $this->getPrice(
            ) . ".00 $" . "/" . "Weight: " . $this->getTypeValue() . "KG";
    }

    public function getTypeValue()
    {
        return $this->typeValue;
    }

    public function setTypeValue($typeValue)
    {
        $this->typeValue = $typeValue;
    }
}