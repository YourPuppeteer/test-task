<?php
use Scandiweb\Controller\FormController\FormController;
use Scandiweb\Controller\ProductController\ProductController;

if (isset($_POST["add_data"])){
    $postData = $_POST["add_data"];
    $formController = new FormController($postData);
    $formController->addProduct();
    exit;
}

if (isset($_POST["delete_data"])){
    $postData = $_POST["delete_data"];
    $productController = new ProductController();
    $productController->deleteProducts($postData);
    exit;
}

if(empty($_GET)){
    include "src/view/ProductList.php";
    exit;
}

if(isset($_GET["page"])){
    if($_GET["page"] == "add-product"){
        include 'src/view/ProductForm.php';
        exit;
    }

    if($_GET["page"] == "product-list"){
        header("Location: ../../../scandiweb");
        exit;
    }
}





