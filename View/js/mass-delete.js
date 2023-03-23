$(document).ready(function () {
    $("#product_form").submit(function (event) {
        event.preventDefault();

        // Get all checked products
        var selectedProducts = $('input[name="selected_products[]"]:checked').map(function() {
            return this.value;
        }).get();

        console.log(selectedProducts);

        // Send the data using post
        $.ajax({
            url: "/scandiweb/Controller/ProductController.php",
            type: "POST",
            data: { selected_products: selectedProducts },
            success: function (data) {

                let parse = JSON.parse(data)

                if (parse.message === "success") {

                    $('#product_form').load('/scandiweb #product_form>*');

                }
            }
        });
    });
});