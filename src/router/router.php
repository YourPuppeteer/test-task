<?php
require_once('../../vendor/autoload.php');


use Scandiweb\Controller\FormController\FormController;
use Scandiweb\Controller\ProductController\ProductController;


if (isset($_POST["add_data"])){
    $postData = $_POST["add_data"];
    $formController = new FormController($postData);
    $formController->addProduct();
}

if (isset($_POST["delete_data"])){
    $postData = $_POST["delete_data"];
    $productController = new ProductController();
    $productController->deleteProducts($postData);

}
