$(document).ready(function () {
    $("#product_form").submit(function (event) {
        event.preventDefault();

        // Get all checked products
        var selectedProducts =
            $('input[name="selected_products[]"]:checked').map(function() {
            return this.value;
        }).get();

        console.log(selectedProducts);

        // Send the data using post
        $.ajax({
            url: "/scandiweb/router/router.php",
            type: "POST",
            data: { delete_data: selectedProducts },
            success: function (data) {
                console.log(data)

                let parse = JSON.parse(data)

                if (parse.message === "success") {

                    $('#product_form').load('/scandiweb #product_form>*');

                }
            }
        });
    });
});





/*
var selectedProducts = [];

const app = new Vue({
    el: '#app',
    methods: {
        submitForm() {
            // Send the data using axios post
            axios.post('/scandiweb/Controller/ProductController.php', {
                selected_products: selectedProducts
            })
                .then(response => {
                    let parse = response.data;
                    if (parse.message === "success") {
                        selectedProducts = [];
                        $('#product_form').load('/scandiweb #product_form>*');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
});*/
