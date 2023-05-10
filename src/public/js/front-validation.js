const form = document.querySelector('#product_form');

// add event listener to form submit event
form.addEventListener('submit', function (event) {
    event.preventDefault();

    const skuRegex = /^[a-zA-Z0-9-]+$/;

    // get form inputs
    const skuInput = document.getElementById('sku');
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const typeInput = document.getElementById('productType');
    //book
    const bookInput = document.getElementById('weight');
    //dvd
    const dvdInput = document.getElementById('size');
    //furniture
    const heightInput = document.getElementById('height');
    const widthInput = document.getElementById('width');
    const lengthInput = document.getElementById('length');

    // get error message elements
    const skuError = document.getElementById('sku-error');
    const nameError = document.getElementById('name-error');
    const priceError = document.getElementById('price-error');
    const typeError = document.getElementById('productType-error');
    const typeValueError = document.getElementById('typeValue-error');

    // check if inputs are empty
    let errors = false

    // SKU front validation
    if (skuInput.value.trim() === '') {
        skuError.textContent = 'Please, submit required data';
        errors = true;
    } else if (skuInput.value.trim().length < 4 || skuInput.value.trim().length > 16) {
        skuError.textContent = 'SKU must be between 4 and 16 characters long';
        errors = true;

    } else if (!skuRegex.test(skuInput.value.trim())) {
        skuError.textContent = "SKU must contain only alphanumeric characters and dashes";
        errors = true;
    } else {
        skuError.textContent = '';
    }


    // Name front validation
    if (nameInput.value.trim() === '') {
        nameError.textContent = 'Please, submit required data';
        errors = true;
    } else {
        nameError.textContent = '';
    }

    // Price front validation
    if (priceInput.value.trim() === '') {
        priceError.textContent = 'Please, submit required data';
        errors = true;
    } else if (priceInput.value.trim() <= 0) {
        priceError.textContent = 'Value should be greater than 0';
        errors = true;
    } else {
        priceError.textContent = '';
    }

    //Type front validation
    if (typeInput.value.trim() === '') {
        typeError.textContent = 'Type is required';
        errors = true;
    } else {
        typeError.textContent = '';
    }

    //TypeValue front validation
    if (typeInput.value.trim() === 'Book') {
        if (bookInput.value.trim() === '') {
            typeValueError.textContent = 'Please, submit required data';
            errors = true;
        } else {
            typeValueError.textContent = '';
        }
    }

    if (typeInput.value.trim() === 'DVD') {
        if (dvdInput.value.trim() === '') {
            typeValueError.textContent = 'Please, submit required data';
            errors = true;
        } else {
            typeValueError.textContent = '';
        }
    }

    if (typeInput.value.trim() === 'Furniture') {
        if (heightInput.value.trim() === '' || widthInput.value.trim() === '' || lengthInput.value.trim() === '') {
            typeValueError.textContent = 'Please, submit required data';
            errors = true;
        } else {
            typeValueError.textContent = '';


            if (heightInput.value.trim() <= 0 || widthInput.value.trim() <= 0 || lengthInput.value.trim() <= 0) {
                typeValueError.textContent = 'Value should be greater than 0';
                errors = true;
            } else {
                typeValueError.textContent = '';
            }
        }

    }

    // submit form if there are no errors
    if (!errors) {

        // Get all input values
        const inputValues = {
            add_data: {
                sku: skuInput.value,
                name: nameInput.value,
                price: priceInput.value,
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
            url: "../index.php",
            type: "POST",
            data: inputValues,
            success: function (data) {
                console.log(data);

                const parse = JSON.parse(data)
                console.log(document.referrer)

                if (parse.message === "success") {
                    window.location.href = "../";
                }

                if (parse.message === "failure") {
                    $("#validationresult").html("There was a problem ");
                }

                if (typeof (parse.message) === "object") {
                    $('.error-message').empty();
                    for (const key in parse.message) {
                        if (parse.message.hasOwnProperty(key)) {
                            // Get the error message and the corresponding input field ID
                            const errorMessage = parse.message[key];
                            const inputFieldId = "#" + key;

                            // Update the error message container for the input field
                            $(inputFieldId + "-error").html(errorMessage);

                            // Add an error class to the input field
                            $(inputFieldId).addClass("error");
                        }
                    }
                }
            }
        });

    } else {
        event.preventDefault();
    }

});