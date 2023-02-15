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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

</head>
<body>

<main>
    <form id="product_form" method="post" action="../Controller/FormController.php">

        <header>
            <h1>Product List</h1>
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
                <input type="text" id="price" name="price" placeholder="#price"><br>


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
                            <input type="text" id="weight" name="weight" placeholder="#size" v-model="product.weight">
                        </div>

                        <div v-if="selectedType === 'Book'">
                            <label for="Book">Weight:</label>
                            <input type="text" id="size" name="size" placeholder="#weight" v-model="product.size">
                        </div>

                        <div v-if="selectedType === 'Furniture'">
                            <label for="height">Height:</label>
                            <input type="number" id="height" name="height" placeholder="#height" v-model="product.height"><br>


                            <label for="width">Width:</label>
                            <input type="number" id="width" name="width" placeholder="#width" v-model="product.width"><br>

                            <label for="length">Length:</label>
                            <input type="number" id="length" name="length" placeholder="#length" v-model="product.length"><br>

                        </div>
                    </div>
                </template>
                <script>
                    new Vue({
                        el: "#app",
                        data: {
                            product: {
                                type: '',
                                weight: '',
                                size: '',
                                height: '',
                                width: '',
                                length: '',
                            },
                            selectedType: '',
                        },
                        watch: {
                            selectedType: function (newType) {
                                if (newType === 'DVD') {
                                    this.product = { type: 'DVD', weight: '', size: '', height: '', width: '', length: '' };
                                } else if (newType === 'Book') {
                                    this.product = { type: 'Book', weight: '', size: '', height: '', width: '', length: '' };
                                } else if (newType === 'Furniture') {
                                    this.product = { type: 'Furniture', weight: '', size: '', height: '', width: '', length: '' };
                                }
                            },
                        },
                    });

                </script>
            </div>


        </form>








    </form>



</main>
</body>
</html>
