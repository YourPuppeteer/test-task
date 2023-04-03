<?php

namespace Scandiweb\Product\Book;

use Scandiweb\Product\Product;

class Book extends Product
{
    public function __construct($sku, $name, $price, $typeValue)
    {
        parent::__construct($sku, $name, $price, $typeValue);
    }

    public function getProduct()
    {
        // TODO: Implement getProduct() method.
        return "SKU:" . $this->getSKU() . " /" . $this->getName() . "/" . $this->getPrice(
            ) . "/" . "Weight: " . $this->getTypeValue() . "KG";
    }

}