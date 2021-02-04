@extends('mongicommerce.template.layout')
@section('title','carrello')
@section('description','i tuoi prodotti nel carrello')
@section('css')
@endsection

@section('content')

    <!-- Section -->
    <div class="container-fluid dark section no-padding">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-sm-push-2">
                    <span class="title">immagine</span>
                </div>
                <div class="col-sm-3 col-sm-push-2">
                    <span class="title">Nome</span>
                </div>
                <div class="col-sm-3">
                    <span class="title">Quantità</span>
                </div>
                <div class="col-sm-2">
                    <span class="title">Elimina</span>
                </div>
                <div class="col-sm-1">
                    <span class="title">Totale</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section -->


    <div style="display: none;" id="div_section_cart" class="container-fluid white section cart mb-5">
        <div class="container">
            <div id="section_cart"></div>

            <div style="float: right;" class="row">
                <div class="col-md-6 btn-wrap">
                    <a href="{{route('shop.shipment')}}" class="btn btn-primary">Prosegui</a>
                </div>
                <div class="col-md-6 total">
                    <p>Totale: <span id="sum_cart"></span></p>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none;" id="div_section_cart_empty" class="container-fluid white section cart">
        <div class="container">
            <div id="section_cart"></div>
            <div class="row">
                <div class="col-sm-12 promo text-center">
                    <h2>Nel tuo carrello non sono presenti prodotti</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            generateCart();
        });

        function createCartHtml(el) {
            let html = '';
            if (el.product.length <= 0) {
                $('#div_section_cart_empty').show();
                $('#div_section_cart').hide();
            } else {
                $.each(el.product, function (index, value) {
                    html += ' <div class="row item"> ' +
                        '<div class="col-sm-2 matchHeight"> ' +
                        '<img width="80" src="' + value.detail.image + '" /> ' +
                        '</div> ' +
                        '<div class="col-sm-4 matchHeight"> ' +
                        '<header class="alignMiddle"> ' +
                        '<h2>' + value.detail.name + '</h2> ' +
                        '</header> ' +
                        '</div> ' +
                        '<div class="col-sm-3 matchHeight"> ' +
                        '<div class="quantity alignMiddle"> ' +
                        '<i  style="cursor:pointer;" onclick="modifyNumberElementInCart(' + value.detail.id + ',-1)" class="fa fa-chevron-down"></i> ' +
                        '<input readonly value="' + value.count + '" type="text"> ' +
                        '<i onclick="modifyNumberElementInCart(' + value.detail.id + ',+1)" style="cursor:pointer;" class="fa fa-chevron-up"></i> ' +
                        '</div> ' +
                        '</div> ' +
                        '<div class="col-sm-2 matchHeight"> ' +
                        '<a href="#" onclick="deleteFromCart(' + value.detail.id + ')" class="remove alignMiddle fa fa-remove"></a> ' +
                        '</div> ' +
                        '<div class="col-sm-1 matchHeight"> ' +
                        '<span class="price alignMiddle">' + formatter.format(value.total) + '</span> ' +
                        '</div> ' +
                        '</div>';
                });
                $('#section_cart').html(html);
                $('#sum_cart').html(formatter.format(el.total.total));
                $('#div_section_cart_empty').hide();
                $('#div_section_cart').show();
            }

        }

        function generateCart() {
            $.ajax({
                method: 'POST',
                url: url_get_cart_product,
                success: function (response) {
                    createCartHtml(response);
                }
            })
        }

        function modifyNumberElementInCart(product_id, operator) {
            $.ajax({
                method: 'POST',
                url: url_increment_number_product_in_cart,
                data: {
                    product_id: product_id,
                    operator: operator
                },
                success: function (response) {
                    generateCart();
                }
            })
        }

        function deleteFromCart(product_id) {
            $.ajax({
                method: 'POST',
                url: url_delete_from_cart,
                data: {
                    product_id: product_id,
                },
                success: function (response) {
                    generateCart();
                }
            })
        }
    </script>
@endsection
