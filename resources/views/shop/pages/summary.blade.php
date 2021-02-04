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
            <div class="row">
                @if($get_in_shop_checkbox == 'true')
                    <div class="col-sm-12">
                        <label for="">Consegna</label>
                        <h3>I PRODOTTI VERRANNO RITIRATI IN NEGOZIO</h3>
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
                <div class="col-sm-6 promo">

                </div>
                <div class="col-sm-6 total">
                    <p>Prodotti: <span id="sum_cart">@money($total)</span></p>
                    <p>Totale: <span>@money($total + $shipping_price)</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('shop.payment')}}" class="btn btn-primary">Prosegui al pagamento</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
@endsection
