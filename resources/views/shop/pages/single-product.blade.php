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
            <p>{{$product->description}}</p>


        </div>
        <div class="col-md-4">
            {{$product->category->name}}
            {{$price}}
            {!! $details_fields !!}
            {!! $configuration_fields !!}
            {!! $btn_cart !!}
            <img width="150" src="{{$qr}}">
        </div>


    </div>
</div>
@endsection
@section('js')
@endsection
