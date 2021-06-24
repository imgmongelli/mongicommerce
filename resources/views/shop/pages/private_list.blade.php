@extends('mongicommerce.template.layout')
@section('title','Lista privata')
@section('description','Visualizza lista')
@section('css')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-md-5 mb-md-3">
            <h1>{{$list->name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-md-5">
            <table id="orders" class="table table-bordered table-hover table-striped w-100">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Foto</th>
                    <th>Nome prodotto</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>#{{$product->id}}</td>
                        <td><img src="{{$product->infoProduct->image}}" width="80"></td>
                        <td>{{$product->infoProduct->name}}</span></td>
                        <td>
                            <a href="{{route('shop.single.product',$product->product_id)}}" class="btn btn-primary">Visualizza</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
@section('js')
@endsection
