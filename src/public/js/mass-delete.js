$(document).ready(function () {
    // Cache the delete button element
    var $deleteButton = $('#delete-product-btn');
    $deleteButton.on('click', deleteButton);

    var $addButton = $('#add_button');
    $addButton.on('click', addButton);

});

function deleteButton(event) {
    event.preventDefault();
    const checkedButtons = $('.delete-checkbox:checked');
    const isChecked = !!checkedButtons.length;
    if (isChecked) {
        const selectedProducts = Array.from(checkedButtons).map((x) => x.value);

        // Send the data using post
        $.ajax({
            url: "index.php",
            type: "POST",
            data: {delete_data: selectedProducts},
            success: function (data) {

                let parse = JSON.parse(data)

                if (parse.message === "success") {
                    selectedProducts.forEach(element => {
                        document.getElementById(element).remove();
                    })

                }
            }
        });
    }
}

function addButton(event){
    event.preventDefault();

    window.location.href = "../scandiweb/add-product";

}