$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getVariationProduct() {
    let data = [];
    let product_id = '';
    let flash_data = [];
    $('.mongifield_into_product').each(function (index,element) {

        let detail_id = $(element).data('detail_id');
        let detail_value = $(element).val();
        product_id = $(element).data('product_id');
        if(detail_value !== ""){
            flash_data[detail_id] = detail_value;
            data.push({'product_detail_id':detail_id,'product_detail_value_id':detail_value});
        }

    });
    console.log(flash_data);
    $.ajax({
        method: 'POST',
        url: url_get_product_variation_information,
        data: {
            product_id : product_id,
            informations : data,
            flash_data : flash_data
        },
        'statusCode': {
            422: function (response) {
            }
        },
        success: function (response) {
            if(response !== false){
                $('.show_error_product').hide();
                window.location.href = response;
            }else{
                $('.show_error_product').show();
            }
        }
    });
}
