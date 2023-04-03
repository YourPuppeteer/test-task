<?php

namespace Scandiweb\Product;

abstract class Product
{
    protected $sku;
    protected $name;
    protected $price;
    protected $typeValue;

    public function __construct($sku, $name, $price, $typeValue)
    {
        $this->setSKU($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->setTypeValue($typeValue);
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getTypeValue()
    {
        return $this->typeValue;
    }

    public function setTypeValue($typeValue)
    {
        $this->typeValue = $typeValue;
    }

    abstract public function getProduct();

}
