<?php
require_once('../vendor/autoload.php');


use Controller\FormController\FormController;
use Controller\ProductController\ProductController;


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
