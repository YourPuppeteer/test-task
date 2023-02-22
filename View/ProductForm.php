<?php
namespace View;
require_once ('../vendor/autoload.php');
session_start();

use Controller\ProductController;
use Product\ProductFetcher\ProductFetcher;
use Product\Main\Product;
use Product\Validation\Validator;
use Controller\FormController;

$fetch = new ProductFetcher();

if (isset($_SESSION['form_errors'])) {
    $errorMessages = $_SESSION['form_errors'];
    $errorArray = explode(", ", $errorMessages);

    echo '<ul>';
    var_dump($errorMessages);
    foreach ($errorArray as $errorMessage){
        echo "<li>$errorMessage</li>";
    }



    echo '</ul>';
    // clear the session variable so the error messages don't persist after the page is reloaded
    unset($_SESSION['form_errors']);
}


?>



<!DOCTYPE html>
<html>
<head>
    <title>Product Form</title>
    <link rel="stylesheet" type="text/css" href="Styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>
<body>

<main>
    <form id="product_form" method="post" action="../Controller/FormController.php">

        <header>
            <h1>Product Add</h1>
            <div class="actions">
                <button type="submit">SAVE</button>
                <a href="ProductList.php">
                    <button type="button">CANCEL</button>
                </a>

            </div>
        </header>

        <form class="form_inputs">
            <div>
                <label for="SKU">SKU </label>
                <input type="text" id="sku" name="sku" placeholder="#sku"><br>

                <label for="Name">Name </label>
                <input type="text" id="name" name="name" placeholder="#name"><br>

                <label for="Price">Price </label>
                <input type="number" id="price" name="price" placeholder="#price"><br>


            </div>
            <div id="app" class="TypeSwitcher">
                <template>
                    <div>
                        <label for="type" >Type:</label>
                        <select v-model="selectedType" id="productType" name="productType" >
                            <option value="DVD" id="DVD">DVD</option>
                            <option value="Book" id="Book">Book</option>
                            <option value="Furniture" id="Furniture">Furniture</option>
                        </select>

                        <div v-if="selectedType === 'DVD'">
                            <label for="DVD">Size:</label>
                            <input type="text" id="weight" name="weight" placeholder="#size" v-model="product.size">
                            <p>Please provide size (in MB) </p>
                        </div>

                        <div v-if="selectedType === 'Book'">
                            <label for="Book">Weight:</label>
                            <input type="text" id="size" name="size" placeholder="#weight" v-model="product.weight">
                            <p>Please provide weight (in KG) </p>
                        </div>

                        <div v-if="selectedType === 'Furniture'">
                            <label for="height">Height:</label>
                            <input type="number" id="height" name="height" placeholder="#height" v-model="product.height"><br>


                            <label for="width">Width:</label>
                            <input type="number" id="width" name="width" placeholder="#width" v-model="product.width"><br>

                            <label for="length">Length:</label>
                            <input type="number" id="length" name="length" placeholder="#length" v-model="product.length"><br>
                            <p>Please provide dimensions in HxWxL format</p>

                        </div>
                    </div>
                </template>
                <script>
                    new Vue({
                        el: "#app",
                        data: {
                            product: {
                                type: '',
                                size: '',
                                weight: '',
                                height: '',
                                width: '',
                                length: '',
                            },
                            selectedType: '',
                        },
                        watch: {
                            selectedType: function (newType) {
                                if (newType === 'DVD') {
                                    this.product = { type: 'DVD', size: '', weight: '', height: '', width: '', length: '' };
                                } else if (newType === 'Book') {
                                    this.product = { type: 'Book', size: '', weight: '', height: '', width: '', length: '' };
                                } else if (newType === 'Furniture') {
                                    this.product = { type: 'Furniture', size: '', weight: '', height: '', width: '', length: '' };
                                }
                            },
                        },
                    });

                </script>
            </div>


        </form>
        <hr class="mt-4 mb-4" style="border: 1px solid black; opacity: 1;"/>
        <p class="text-center mb-4">Scandiweb Test assignment</p>








    </form>



</main>
</body>
</html>
