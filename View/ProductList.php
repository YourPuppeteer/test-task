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

                    <button  type="button" onclick="window.location.href='ProductForm.php';">ADD</button>

                    <button  type="submit" id="delete-product-btn" name="delete-product-btn">MASS DELETE</button>
                </div>
            </header>

            <?php foreach ($fetch->fetchProducts() as $i => $product): ?>
                <?php if ($i % 4 === 0): ?>
                    <div class="row">
                <?php endif; ?>
                <div class="column">
                    <label>
                        <?php
                        $sku = $product;
                        $skuArray = explode("SKU:", $sku);
                        $sku_parts = explode('/', $skuArray[1]);
                        $skuValue = $sku_parts[0];
                        ?>
                        <input type="checkbox" name="selected_products[]" value="<?php echo $skuValue ?>">
                        <?php
                        foreach ($sku_parts as $part){
                            echo $part;
                            echo "<br>";
                        }
                        ?>

                    </label>
                </div>
                <?php if (($i + 1) % 4 === 0 || ($i + 1) === count($fetch->fetchProducts())): ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </form>

    </main>
</body>
</html>

