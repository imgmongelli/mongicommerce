@extends('mongicommerce.template.layout')
@section('title',$product->name)
@section('description',$product->description)
@section('css')
@endsection

@section('content')
<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-8">
            <img src="{{$image}}" alt="">
            


        </div>
        <div class="col-md-3">
            {{$product->category->name}}
            {{$price}}
            {!! $details_fields !!}
            {!! $configuration_fields !!}
            {!! $btn_cart !!}
            
        </div>
        <div class="col-md-1">
            <img width="100%" src="{{$qr}}">
        </div>


    </div>
    <h4>Descrizione prodotto</h4>
    <div class="row mt-3 mb-4">
        <div class="col-md-12">
            <p>{{$product->description}}</p>
        </div>
       
    </div>
</div>
@endsection
@section('js')
@endsection
