@extends('mongicommerce.template.layout')
@section('title',$product->name)
@section('description',$product->description)
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-8">
            <img src="https://placehold.it/600x400" alt="">
            <p>{{$product->description}}</p>


        </div>
        <div class="col-md-4">
            {!! $details_fields !!}
        </div>


    </div>
@endsection
@section('js')
@endsection
