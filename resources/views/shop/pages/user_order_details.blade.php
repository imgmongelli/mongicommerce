@extends('mongicommerce.template.layout')
@section('title','Dettagli ordini')
@section('description','Prodotti acquistati')
@section('css')
@endsection
@section('content')
@if (Session::has('error'))
<div class="alert alert-danger text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('error') }}</p>
</div>
@endif
@if (Session::has('success'))
<div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
</div>
@endif

<div class="container">
    <div class="row col-12 mt-4">
        <h2>Dettagli ordine</h2>
    </div>
    <div class="row">
        <div class="col-md-12 mt-md-5 mb-md-5">
            <table id="orders" class="table table-bordered table-hover table-striped w-100">
                <thead>
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th>Numero prodotti</th>
                    <th>Prezzo</th>
                    <th>Categoria</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products_items as $product_item)
                    <tr>
                        <td><img width="70" src="{{asset($product_item->image)}}"></td>
                        <td>{{$product_item->name}}</td>
                        <td><span class="badge badge-warning">{{$product_item->pivot->number_products}}</span></td>
                        <td>@money($product_item->price)</td>
                        <td>{{$product_item->category->name}}</td>
                        <td>
                            @if($product_bool[$product_item->product_id] == 1 and $show_code)
                                <a href="{{route('shop.user.gift.card', ['order_id' => $order->id, 'id' => $product_item->id])}}" class="custom-link">Vedi gift card</a>
                                {{--                                <div class="d-flex flex-column">--}}
                                {{--                                    @for($i = 0; $i < $product_item->pivot->number_products; $i++)--}}
                                {{--                                        <a href="{{route('shop.download.gift')}}" class="custom-link">Stampa gift card {{$i + 1}}</a>--}}
                                {{--                                        <button class="btn" onclick="printGift({{$i}})">Stampa gift card {{$i + 1}}</button>--}}
                                {{--                                    @endfor--}}
                                {{--                                </div>--}}
                            @elseif($product_bool[$product_item->product_id] == 1 and !$show_code)
                                Il codice della gift verrà rilasciato dopo la ricezione del pagamento
                            @else
                                -
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
@section('js')
@endsection
