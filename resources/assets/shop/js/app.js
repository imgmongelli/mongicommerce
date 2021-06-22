$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

updateCart();

function getVariationProduct() {
    let data = [];
    let product_id = '';
    let flash_data = [];
    $('.mongifield_into_product').each(function (index, element) {

        let detail_id = $(element).data('detail_id');
        let detail_value = $(element).val();
        product_id = $(element).data('product_id');
        if (detail_value !== "") {
            flash_data[detail_id] = detail_value;
            data.push({ 'product_detail_id': detail_id, 'product_detail_value_id': detail_value });
        }

    });
    console.log(flash_data);
    $.ajax({
        method: 'POST',
        url: url_get_product_variation_information,
        data: {
            product_id: product_id,
            informations: data,
            flash_data: flash_data
        },
        'statusCode': {
            422: function (response) {
            }
        },
        success: function (response) {
            if (response !== false) {
                $('.show_error_product').hide();
                window.location.href = response;
            } else {
                $('.show_error_product').show();
            }
        }
    });
}

function addToCart(el) {
    let product_item_id = $(el).data('product_item_id');
    let route_add_to_cart = url_add_to_cart;

    $.ajax({
        method: 'POST',
        url: route_add_to_cart,
        data: {
            product_item_id: product_item_id,
        },
        'statusCode': {
            422: function (response) {
                //get first error to show it on top of pagse
                error422Badge(response);
            }
        },
        success: function (response) {
            updateCart();
            bootoast.toast({
                message: 'Hai aggiunto il prodotto al tuo carrello! Continua oppure <br> vai al <a href="' + url_cart_page + '"> <span class="fa fa-shopping-cart" aria-hidden="true"></span>  Carrello</a>',
                position: 'rightTop',
                icon: 'exclamation-sign',
                type: 'warning',
                animationDuration: 300,
            });
        }
    });

}

function error422(response) {
    let errors = response.responseJSON.errors;
    let message_error = '';
    $.each(errors, function (key, value) {
        message_error += "C'è un problema per il campo (" + key + ")" + "<br>";
    });
    bootoast.toast({
        message: message_error,
        position: 'top',
        icon: 'exclamation-sign',
        type: 'error',
        animationDuration: 300,
    });
}

function updateCart() {
    $.ajax({
        method: 'POST',
        url: url_get_cart_elements,
        success: function (response) {
            $('.space_cart').text(response);
        }
    });
}

const formatter = new Intl.NumberFormat('it-IT', {
    style: 'currency',
    currency: 'EUR',
    minimumFractionDigits: 2
});

function error422Badge(response) {
    let error_message = response.responseJSON.errors;
    bootoast.toast({
        message: error_message,
        position: 'top',
        icon: 'exclamation-sign',
        type: 'error',
        animationDuration: 300,
    });
}