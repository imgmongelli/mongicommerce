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
                        <img class="card-img-top" width="100%" src="{{$product->image}}" alt="" style="max-height: 335px;min-height: 335px;">
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
</div>
@endsection
@section('js')
@endsection
