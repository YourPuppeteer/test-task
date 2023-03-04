<?php
namespace Root;
session_start();

$_SESSION['url'] = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://" .  $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$pathInPieces = explode('/', $_SERVER['DOCUMENT_ROOT']);
$requestUri = $_SERVER['REQUEST_URI'];



if ($requestUri === '/scandiweb/') {
    include 'View/ProductList.php';
    exit;
}

if ($requestUri === '/scandiweb/add-product') {
    include 'View/ProductForm.php';
    exit;
}

// handle 404 error
http_response_code(404);
include "View/404.php";