@extends('mongicommerce.template.layout')
@section('title',$category_name)
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
                        <img class="card-img-top" width="100%" src="{{$product->image}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{$product->name}}</h4>
                            <p class="card-text">{{$product->description}}</p>
                            <p class="badge badge-danger">{{$product->category->name}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{route('shop.single.product',$product->id)}}" class="btn btn-primary">Acquista</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
@section('js')
@endsection
