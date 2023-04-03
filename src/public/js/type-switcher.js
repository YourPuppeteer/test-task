$('#productType').on('change', function () {
    // Get the selected value
    const selectedType = $(this).val();

    // Include the component based on the selected type
    if (selectedType === 'DVD') {
        includeComponent('src/public/html/dvd_component.html');
    } else if (selectedType === 'Book') {
        includeComponent('src/public/html/book_component.html');
    } else if (selectedType === 'Furniture') {
        includeComponent('src/public/html/furniture_component.html');
    }
});

function includeComponent(componentUrl) {
    $.ajax({
        url: componentUrl,
        success: function (response) {
            // Insert the component HTML into the DOM
            $('#component-container').html(response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching component:', errorThrown);
        }
    });
}