@extends('mongicommerce.template.layout')
@section('title', 'Risultati ricerca')
@section('description', '')
@section('css')
@endsection

@section('content')
<div class="container mt-3">
    <div class="row d-flex flex-column justify-content-around" style="padding-left: 1rem">
        <h1>Risultati ricerca</h1>
        <br>
        <h6>{{$products->count()}} risconto(i) per '{{request()->input('query')}}'</h6>
        <hr>
    </div>
    @if($products->count() == 0)
        <div id="section_cart"></div>
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <div class="col-sm-12 promo text-center">
                <h2>Nessun risultato</h2>
            </div>
        </div>
    @else
        <div class="row">
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
                                <a href="{{route('shop.single.product',$product->id)}}" class="btn btn-primary">Acquista</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
@endsection
@section('js')
@endsection
