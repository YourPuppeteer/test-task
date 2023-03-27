$(document).ready(function () {
    $("#product_form").submit(function (event) {
        event.preventDefault();


        // Get all input values
        var inputValues = {
            add_data:{
                sku: $("#sku").val(),
                name: $("#name").val(),
                price: $("#price").val(),
                productType: $("#productType").val(),
                weight: $("#weight").val(),
                size: $("#size").val(),
                height: $("#height").val(),
                width: $("#width").val(),
                length: $("#length").val()
            }

        };

        // Send the data using post
        $.ajax({
            url: "/scandiweb/router/router.php",
            type: "POST",
            data: inputValues,
            success: function (data) {
                console.log(data);

                let parse = JSON.parse(data)



                if (parse.message === "success") {

                    window.location.href = '/scandiweb';

                }
                if (parse.message === "failure") {
                    $("#validationresult").html("There was a problem ");
                }

                if (typeof (parse.message) === "object") {
                    //$("#validationresult").html(JSON.stringify(parse.message));
                    $('.error-message').empty();
                    for (let key in parse.message) {
                        if (parse.message.hasOwnProperty(key)) {
                            // Get the error message and the corresponding input field ID
                            let errorMessage = parse.message[key];
                            let inputFieldId = "#" + key;

                            // Update the error message container for the input field
                            $(inputFieldId + "-error").html(errorMessage);

                            // Add an error class to the input field
                            $(inputFieldId).addClass("error");

                        }
                    }
                }
            }
        });
    });
});