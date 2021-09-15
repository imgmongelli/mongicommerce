@extends('mongicommerce.template.layout')
@if($category_name === '')
    @section('title', 'Negozio')
@else
    @section('title',$category_name)
@endif
@section('description',$category_description)
@section('css')
@endsection

@section('content')
<div class="container">
    <div class="row mt-5">

        @foreach($products as $product)
            @if(!$product->is_reserved)
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <div class="d-flex justify-content-center">
                            <img class="card-img-top" src="{{$product->image}}" alt="" style="height: 280px;width: auto;">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{$product->name}}</h4>
                            <p class="badge badge-danger">{{$product->category->name}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('shop.single.product',$product->id)}}" class="btn btn-primary btn-block">Acquista</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @if(count($products) == 0)
        <div class="container">
            <div class="row mt-5 mb-5">
                <div class="col-sm-12 promo text-center mt-5 mb-4">
                    <h2>Non è presente alcun prodotto per la categoria '{{$category_name}}'.</h2>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
@section('js')
@endsection
