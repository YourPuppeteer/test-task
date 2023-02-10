<?php
namespace Product\Main;


abstract class Product{
    protected $sku;
    protected $name;
    protected $price;





    public function __construct($sku,$name,$price)
    {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    public function setSKU($sku)
    {
        $this->sku = $sku;
    }

    public function getSKU()
    {
        return $this->sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }

    abstract public function getProduct();

}
