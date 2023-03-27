<?php

namespace View;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Form</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['url']?>/../View/Styles/style.css">
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
            <h1>Product Add</h1>
            <div class="actions">
                <button type="submit" class="buttons-w">SAVE</button>
                <a href="<?php echo $_SESSION['url']?>/../">
                    <button type="button">CANCEL</button>
                </a>

            </div>
        </header>


        <form class="form_inputs">
            <div class="row flex-row">
                <div class="d-flex mb-3" >
                    <label for="SKU" class="col-form-label">SKU </label>
                    <input type="text" class="form-control form-input" id="sku" name="sku" placeholder="#sku"><br>
                    <span class="error-message" id="sku-error"></span>
                </div>


                <div class="d-flex mb-3">
                    <label for="Name" class="col-form-label">Name </label>
                    <input type="text" class="form-control form-input" id="name" name="name" placeholder="#name"><br>
                    <span class="error-message" id="name-error"></span>
                </div >



                <div class="d-flex mb-3">
                    <label for="Price" class="col-form-label">Price ($)</label>
                    <input type="number" class="form-control form-input" id="price" name="price" placeholder="#price"><br>
                    <span class="error-message" id="price-error"></span>
                </div>


            </div>
            <div id="app" class="TypeSwitcher row flex-row">
                <template>
                    <div class="d-flex type-class mb-3">
                        <label for="type" class="col-form-label ">Type Switcher:</label>
                        <select v-model="selectedType" id="productType" name="productType" class="form-control form-select">
                            <option value="" disabled selected>Type Switcher</option>
                            <option value="DVD" id="DVD">DVD</option>
                            <option value="Book" id="Book">Book</option>
                            <option value="Furniture" id="Furniture">Furniture</option>
                        </select>
                        <span class="error-message" id="productType-error"></span>

                    </div>

                    <div v-if="selectedType === 'DVD'">
                        <div class="d-flex mb-3">
                            <label for="DVD" class="col-form-label">Size:</label>
                            <input type="text" class="form-control form-input" id="weight" name="weight" placeholder="#size"
                                   v-model="product.size">
                            <span class="error-message" id="typeValue-error"></span>

                        </div>
                            <p class="type_description">Please provide size (in MB) </p>
                    </div>

                    <div v-if="selectedType === 'Book'">
                        <div class="d-flex mb-3">
                            <label for="Book" class="col-form-label">Weight:</label>
                            <input type="text" class="form-control form-input" id="size" name="size" placeholder="#weight"
                                   v-model="product.weight">
                            <span class="error-message" id="typeValue-error"></span>

                        </div>
                        <p class="type_description">Please provide weight (in KG) </p>
                    </div>

                    <div v-if="selectedType === 'Furniture'">

                        <div class="d-flex mb-3">
                            <label for="height" class="col-form-label">Height:</label>
                            <input type="number" class="form-control form-input" id="height" name="height" placeholder="#height"
                                   v-model="product.height"><br>
                            <span class="error-message" id="typeValue-error"></span>
                        </div>

                        <div class="d-flex mb-3">
                            <label for="width" class="col-form-label">Width:</label>
                            <input type="number" class="form-control form-input" id="width" name="width" placeholder="#width"
                                   v-model="product.width"><br>
                            <span class="error-message" id="typeValue-error"></span>
                        </div>

                        <div class="d-flex mb-3">
                            <label for="length" class="col-form-label">Length:</label>
                            <input type="number" class="form-control form-input" id="length" name="length" placeholder="#length"
                                   v-model="product.length"><br>
                            <span class="error-message" id="typeValue-error"></span>

                        </div>
                        <p class="type_description">Please provide dimensions in HxWxL format</p>


                    </div>



                </template>
                <!--Type Switcher vue -->





            </div>

        </form>
        <hr class="mt-4 mb-4" style="border: 1px solid black; opacity: 1;"/>
        <p class="text-center mb-4">Scandiweb Test assignment</p>


    </form>

    <div id="validationresult"></div>
    <!-- Jquery to select DOM elements and Ajax to send an HTTP request and receive a response -->



</main>
</body>
<script src="<?php echo $_SESSION['url']?>/../View/js/validation-ajax-jquery.js"></script>
<script src="<?php echo $_SESSION['url']?>/../View/js/product-form.js"></script>


</html>
