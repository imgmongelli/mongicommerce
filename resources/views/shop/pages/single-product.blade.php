@extends('mongicommerce.template.layout')
@section('title',$product->name)
@section('description',$product->description)
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            <img src="{{$product->image}}" alt="">
            <p>{{$product->description}}</p>


        </div>
        <div class="col-md-4">
            {{$product->category->name}}
            {{$product->price}}
            {!! $details_fields !!}
            {!! $configuration_fields !!}
            {!! $btn_cart !!}
        </div>


    </div>
@endsection
@section('js')
@endsection
