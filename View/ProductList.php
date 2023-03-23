<?php

namespace View;

$requestUri = $_SERVER['REQUEST_URI'];

$root = __DIR__ . "\\..\\";

require_once ($root .  "\\vendor\\autoload.php");

use Product\ProductFetcher\ProductFetcher;

$fetch = new ProductFetcher();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['url']?>View/Styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

<main>
    <form id="product_form" method="post" action="">

        <header class="mb-4">
            <h1>Product List</h1>
            <div class="actions">
                <button type="button" onclick="window.location.href='<?php  echo $_SESSION['url']?>add-product';">ADD</button>
                <button type="submit" id="delete-product-btn" name="delete-product-btn">MASS DELETE</button>
            </div>
        </header>

        <div class="container">
            <div class="row">
                <?php
                foreach ($fetch->fetchProducts() as $i => $product): ?>

                    <div class="col-md-3 mb-4">
                        <label class="product-item">
                            <?php
                            $sku = $product;
                            $skuArray = explode("SKU:", $sku);
                            $sku_parts = explode('/', $skuArray[1]);
                            $skuValue = $sku_parts[0];
                            ?>
                            <input class="floating-checkbox" type="checkbox" name="selected_products[]" value="<?php
                            echo $skuValue ?>">
                            <?php
                            foreach ($sku_parts as $part) {
                                echo $part;
                                echo "<br>";
                            }
                            ?>

                        </label>
                    </div>

                <?php
                endforeach; ?>
                <hr class="mt-4 mb-4" style="border: 1px solid black; opacity: 1;"/>
                <p class="text-center mb-4">Scandiweb Test assignment</p>
            </div>
        </div>
    </form>

</main>
</body>
<script src="<?php echo $_SESSION['url']?>/../View/js/mass-delete.js"></script>
<script src="<?php echo $_SESSION['url']?>/../View/js/to-product-form.js"></script>
<script src="<?php echo $_SESSION['url']?>/../View/js/product-form.js"></script>
</html>

