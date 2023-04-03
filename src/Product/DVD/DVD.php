<?php

namespace Scandiweb\Product\DVD;

use Scandiweb\Product\Product;

class DVD extends Product
{

    public function __construct($sku, $name, $price, $typeValue)
    {
        parent::__construct($sku, $name, $price, $typeValue);
    }

    public function getProduct()
    {
        // TODO: Implement getProduct() method.
        return "SKU:" . $this->getSKU() . "/" . $this->getName() . "/" . $this->getPrice(
            )  . "/" . "Size: " . $this->getTypeValue() . " MB";
    }
}