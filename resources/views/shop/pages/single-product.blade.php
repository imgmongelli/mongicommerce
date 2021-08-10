@extends('mongicommerce.template.layout')
@section('title',$product->name)
@section('description',$product->description)
@section('css')
@endsection

@section('content')
    @if(isset($err))
        <div class="container h-100">
            <div class="row col-12 d-flex flex-column justify-content-center align-items-center h-100">
                <h1 class="danger">Prodotto non disponibile!</h1><br><br>
                <h2 class="danger">Tornerà a breve</h2>
            </div>
        </div>
    @else
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-6">
                <img src="{{$image}}" alt="">
            </div>
            <div class="col-md-5">
                <h2>{{$product->name}}</h2>
                {{$product->category->name}}
                <hr>
                {!! $details_fields !!}
                <h5>Descrizione prodotto</h5>
                <div class="row mt-3 mb-4">
                    <div class="col-md-12">
                        <p>{{$description}}</p>
                    </div>

                </div>

                <h4>€ {{$price}}</h4>
                {!! $btn_cart !!}

            </div>
            <div class="col-md-1">
                <img width="100%" src="{{$qr}}">
            </div>


        </div>

        <div class="row mt-3 mb-4">
            <div class="col-md-12">
                {!! $configuration_fields !!}
            </div>
        </div>
    </div>
    @endif
@endsection
@section('js')
@endsection
