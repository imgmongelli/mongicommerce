@extends('mongicommerce.template.layout')
@section('title','riepilogo')
@section('description','')
@section('css')
@endsection
@section('content')
    <div class="container-fluid white section cart">
        <div class="container">
            <div class="row">
                <header class="centred">
                    <h1>Prodotti</h1>
                </header>
            </div>
            <hr class="space-40" />

            @foreach($products as $product)
                <div class="row item">
                    <div class="col-sm-2 matchHeight">
                        <img width="80" src="{{$product['detail']->image}}" alt="Beer can mockup" />
                    </div>
                    <div class="col-sm-4 matchHeight">
                        <header class="alignMiddle">
                            <h2>{{$product['detail']->name}}</h2>
                            <span>{{$product['detail']->category->name}}</span>
                        </header>
                    </div>
                    <div class="col-sm-3 matchHeight">
                        <div class="quantity alignMiddle">
                            <input disabled value="{{$product["count"]}}" type="text">
                        </div>
                    </div>
                    <div class="col-sm-2 matchHeight">
                        <span class="price alignMiddle">@money($product['detail']->price * $product["count"])</span>
                    </div>
                </div>
            @endforeach
            <hr>
            <div class="row">
                @if($get_in_shop_checkbox == 'true')
                    <div class="col-sm-12">
                        <label for="">Consegna</label>
                        <h3>I PRODOTTI VERRANNO RITIRATI IN NEGOZIO</h3>
                        <hr>
                    </div>
                @endif
                @empty(!$note)
                    <div class="col-md-12">
                        <label for="">Note</label>
                        <textarea class="form-control">{{$note}}</textarea>
                    </div>
                @endempty
            </div>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-6 total d-flex flex-column align-items-md-stretch justify-content-center">
                    <p>Prodotti: <span id="sum_cart">@money($total)</span></p>
                    @if(isset($get_coupon_discount_name))
                        <div class="d-flex justify-content-between">
                            <div>
                                Codice ({{ $get_coupon_discount_name }}):
                                <span id="sum_cart"> @money( -$get_coupon_discount_price)</span>
                            </div>

                            <button onclick="deleteCoupon()" class="btn-nostyle">Rimuovi</button>
                        </div>
                        <p>Spedizione: <span id="sum_cart">@money($shipping_price)</span></p>
                        <p>Totale: <span>
                                @if($total + $shipping_price - $get_coupon_discount_price > 0)
                                    @money($total + $shipping_price - $get_coupon_discount_price)
                                @else
                                    @money(0)
                                @endif
                            </span></p>
                    @else
                        <p>Spedizione: <span id="sum_cart">@money($shipping_price)</span></p>
                        <p>Totale: <span>@money($total + $shipping_price)</span></p>
                    @endif
                    <hr>
                    <span>Hai un codice?</span>
                    <div class="coupon">
                        <input id="code_input" placeholder="Inserisci codice">
                        <button type="button" onclick="applyCoupon()" class="btn">Applica</button>
                        <p class="show_error_coupon" style="color: red; display: none;">Codice non valido!</p>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-end align-items-end">
                    <a href="{{route('shop.payment')}}" class="btn btn-primary">Prosegui al pagamento</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        function applyCoupon(){
            $('.show_error_coupon').hide();
            $.ajax({
                method:'post',
                url:"{{route('shop.summary.coupon')}}",
                data:{
                    gift_card_code : $('#code_input').val(),
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success:function (response){
                    if(response.error != undefined){
                        $('.show_error_coupon').show();
                    }else{
                        window.location.href = response.link;
                    }
                }
            })
        }

        function deleteCoupon() {
            $.ajax({
                method:'post',
                url:"{{route('shop.summary.remove.coupon')}}",
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success:function (response){
                    window.location.href = response.link;
                }
            })
        }
    </script>
@endsection
