<?php
require_once ('vendor/autoload.php');

use Product\ProductFetcher\ProductFetcher;

$fetch = new ProductFetcher();
var_dump($fetch->fetchProducts());






