<?php
namespace View;
require_once ('../vendor/autoload.php');

use Product\ProductFetcher\ProductFetcher;
use Product\Main\Product;



$fetch = new ProductFetcher();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="Styles/style.css">
</head>
<body>

<main>
    <form id="product_form" method="post" action="../Controller/ProductController.php">

        <header>
            <h1>Product List</h1>
            <div class="actions">
                <button type="button">ADD</button>
                <button  type="submit" id="delete-product-btn" name="delete-product-btn">MASS DELETE</button>
            </div>
        </header>


    </form>

</main>
</body>
</html>
