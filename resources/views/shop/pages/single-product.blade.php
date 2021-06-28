@extends('mongicommerce.template.layout')
@section('title',$product->name)
@section('description',$product->description)
@section('css')
@endsection

@section('content')
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
                        <p>{{$product->description}}</p>
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
@endsection
@section('js')
@endsection
