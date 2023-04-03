<?php

namespace Scandiweb\Product\Furniture;

use Scandiweb\Product\Product;

class Furniture extends Product
{
    public function __construct($sku, $name, $price, $typeValue)
    {
        parent::__construct($sku, $name, $price, $typeValue);
    }

    public function getProduct()
    {
        // TODO: Implement getProduct() method.
        return "SKU:" . $this->getSKU() . "/" . $this->getName() . "/" . $this->getPrice(
            ) . "/" . "Dimensions: " . $this->getTypeValue();
    }

}