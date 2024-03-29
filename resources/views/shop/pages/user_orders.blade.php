@extends('mongicommerce.template.layout')
@section('title','I tuoi ordini')
@section('description','Lista dei tuoi ordini')
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
    <div class="row">
        <div class="col-md-12 mt-md-5 mb-md-2">
            <table id="orders" class="table table-bordered table-hover table-striped w-100">
                <thead>
                <tr>
                    <th><span class="fa fa-shopping-cart"></span> Ordine</th>
                    <th>Data</th>
                    <th>Stato</th>
                    <th>ID Tracking (se disponibile)</th>
                    <th>Totale</th>
                    <th>Tipologia Pagamento</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>#{{$order->id}}</td>
                        <td>{{$order->created_at->format('d/m/Y')}}</td>
                        <td><span class="badge {{$order->status->color}}">{{$order->status->name}}</span></td>
                        <td>{{$order->id_shipping}}</td>
                        <td>@money($order->total_price)</td>
                        <td>{{$order->typePayment->name}}</td>
                        <td><a href="{{route('shop.user.order.details', $order->id)}}" class="custom-link">Dettagli ordine</a></td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@if(count($orders) === 0)
    <div class="container">
        <div class="row">
            <div class="col-sm-12 promo text-center mt-5 mb-4">
                <h2>Non è presente alcun ordine.</h2>
            </div>
        </div>
    </div>
@endif

@endsection
@section('js')
@endsection
