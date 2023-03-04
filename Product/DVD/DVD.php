<?php

namespace Product\DVD;

use Product\Main\Product;

class DVD extends Product
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
        return "SKU:" . $this->getSKU() . "/" . $this->getName() . "/" . $this->getPrice(
            ) . " $" . "/" . "Size: " . $this->getTypeValue();
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