@extends('mongicommerce::admin.template.layout')
@section('title','Ordine N°'.$order->id)
@section('title_icon',"fa-shopping-cart")
@section('subtitle','Ordine in arrivo')
@section('description','Puoi vedere i dettagli dell ordine')
@section('css')
@endsection
@section('subheader')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informazioni Ordine</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label> ID Ordine:</label>
                        <input type="text" value="{{$order->id}}" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label> Prezzo Spedizione:</label>
                        <input type="text" value="@money($order->shipping_price)" class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label> Prezzo Ordine:</label>
                        <input type="text" value="@money($order->total_price - $order->shipping_price)"
                            class="form-control" readonly>
                    </div>
                    <div class="col-md-2">
                        <label> Peso ordine:</label>
                        <input type="text" value="{{$order->order_weight}}" class="form-control" readonly>
                    </div>
                    <div class="col-md-3">
                        <label> Prezzo totale:</label>
                        <input type="text" value="@money($order->total_price)" class="form-control" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Note spedizione:</label>
                        <textarea class="form-control" disabled>{{$order->note_delivery}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Stato ordine:</label>
                        <select onchange="changeStatus(this,{{$order->id}})" class="form-control" name="" id="">
                            @foreach($statuses as $status)
                            <option {{$status->id == $order->status_id ? 'selected':''}} value="{{$status->id}}">
                                {{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label> Codice di spedizione:</label>
                        <input type="text" id="id_shipping" value="{{$order->id_shipping}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label> Gift card utilizzata:</label>
                        <input type="text" id="id_shipping" @if($order->gift_code_id != null) value="si" @else value="no" @endif class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label> Nome gift card:</label>
                        <input type="text" id="id_shipping" @if($order->gift_code_id != null) value="{{$product_item_gift->name}}" @else value="-" @endif class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label> Valore gift card:</label>
                        <input type="text" id="id_shipping" @if($order->gift_code_id != null) value="€ {{$product_item_gift->price}}" @else value="-" @endif class="form-control">
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <button onclick="saveShippingCode()" class="btn btn-primary">Salva</button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informazioni cliente</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label> ID cliente:</label>
                        <input type="text" id="id" value="{{$cliente->id}}" class="form-control" readonly>
                    </div>
                    <div class="col-md-5">
                        <label>Nome:</label>
                        <input type="text" id="nome" value="{{$cliente->first_name}}" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label>Cognome:</label>
                        <input type="text" id="cognome" value="{{$cliente->last_name}}" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Email:</label>
                        <input type="text" id="email" class="form-control" value="{{$cliente->email}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Ragione Sociale:</label>
                        <input type="text" id="ragione_sociale" class="form-control" value="{{$cliente->company}}">
                    </div>
                    <div class="col-md-6">
                        <label>Partita IVA:</label>
                        <input type="text" id="piva" class="form-control" value="{{$cliente->piva}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Citta:</label>
                        <input type="text" id="fax" class="form-control" value="{{$cliente->city}}">
                    </div>
                    <div class="col-md-3">
                        <label>Indirizzo:</label>
                        <input type="text" id="indirizzo" class="form-control" value="{{$cliente->address}}">
                    </div>
                    <div class="col-md-3">
                        <label>Cap:</label>
                        <input type="text" id="cap" class="form-control" value="{{$cliente->cap}}">
                    </div>
                    <div class="col-md-3">
                        <label>Telefono:</label>
                        <input type="text" id="telefono" class="form-control" value="{{$cliente->telephone}}">
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Prodotti acquistati dal cliente</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>immagine</th>
                            <th>Nome</th>
                            <th>Numero prodotti</th>
                            <th>prezzo</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img width="70" src="{{asset($product->image)}}"></td>
                            <td>{{$product->name}}</td>
                            <td><span class="badge badge-warning">{{$product->pivot->number_products}}</span></td>
                            <td>@money($product->price)</td>
                            <td>{{$product->category->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
@endsection
@section('js')
@endsection
