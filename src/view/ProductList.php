<?php
$requestUri = $_SERVER['REQUEST_URI'];
require_once ("vendor/autoload.php");

use Scandiweb\Helpers\ProductFetcher\ProductFetcher;

$fetch = new ProductFetcher();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="src/public/styles/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<main>

        <div id="app">
            <form id="product_form" @submit.prevent="submitForm">
                <header class="mb-4">
                    <h1>Product List</h1>
                    <div class="actions">
                        <button type="button" onclick="window.location.href='add-product'">ADD</button>
                        <button type="button" id="delete-product-btn" name="delete-product-btn">MASS DELETE</button>
                    </div>
                </header>

                <div class="container">
                    <div class="row">
                        <?php
                        foreach ($fetch->fetchProducts() as $i => $product): ?>
                            <?php
                            $sku = $product;
                            $skuArray = explode("SKU:", $sku);
                            $sku_parts = explode('/', $skuArray[1]);
                            $skuValue = trim($sku_parts[0]);
                            ?>

                            <div class="col-md-3 mb-4" id="<?php echo $skuValue ?>">
                                <label class="product-item">

                                    <input class="floating-checkbox delete-checkbox" type="checkbox" name="selected_products[]" value="<?php
                                    echo $skuValue ?>">
                                    <a><?php echo $sku_parts[0] ?></a></break>
                                    <a><?php echo $sku_parts[1] ?></a></break>
                                    <a><?php echo strpos($sku_parts[2], '.') === false ? $sku_parts[2] . '.00' . " $" : $sku_parts[2] . " $"; ?></a></break>
                                    <a><?php echo $sku_parts[3] ?></a></break>

                                   <?php
/*                                    foreach ($sku_parts as $part) {
                                        echo $part;
                                        echo "<br>";
                                    }
                                    */?>

                                </label>
                            </div>

                        <?php
                        endforeach; ?>
                        <hr class="mt-4 mb-4" style="border: 1px solid black; opacity: 1;"/>
                        <p class="text-center mb-4">Scandiweb Test assignment</p>
                    </div>
                </div>
            </form>
        </div>


</main>
</body>
<script src="src/public/js/mass-delete.js"></script>

<!--<script src="<?php echo $_SESSION['url']?>/../View/js/product-form.js"></script>-->
</html>

