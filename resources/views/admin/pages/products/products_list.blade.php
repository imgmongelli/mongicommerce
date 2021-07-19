@extends('mongicommerce::admin.template.layout')
@section('title','Lista Prodotti')
@section('title_icon',"fa-books")
@section('subtitle','')
@section('description','Mostra lista dei prodotti inseriti')
@section('css')
    <link rel="stylesheet" media="screen, print" href="{{css('datagrid/datatables/datatables.bundle.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Lista prodotti
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome Prodotto</th>
                                <th>Descrizione Prodotto</th>
                                <th>Categoria</th>
                                <th>Creato</th>
                                <th>Modificato</th>
                                <th>In evidenza</th>
                                <th>Azioni</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->created_at->format('d/m/Y')}}</td>
                                    <td>{{$product->updated_at->format('d/m/Y')}}</td>
                                    <td><input data-id="{{$product->id}}" type="checkbox" {!! $product->is_home == true ? 'checked':'' !!} onclick="saveInHome(this)"></td>
                                    <td>
                                        @if($product->single_product)
                                            <button data-id="{{$product->id}}" onclick="deleteProduct(this)" class="btn btn-danger">Elimina</button>
                                            <button data-id="{{$product->id}}" onclick="showMore(this)" class="btn btn-secondary">Dettagli</button>
                                        @else
                                            <a href="{{route('admin.product.new.variante',$product->id)}}" class="btn btn-warning">Varianti</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach



                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="show_product_detail" style="display: none">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Dettagli prodotto selezionato
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome Prodotto</th>
                                <th>Descrizione Prodotto</th>
                                <th>Categoria</th>
                                <th>Quantità disponibile</th>
                                <th>Prezzo(€)</th>
                                <th>Peso(Kg)</th>
                                <th>Creato</th>
                                <th>Modificato</th>
                                <th>Azioni</th>
                            </tr>
                            </thead>
                            <tbody id="product_detail">


                            </tbody>
                        </table>
                        <!-- datatable end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{js('datagrid/datatables/datatables.bundle.js')}}"></script>
    <script>
        $(document).ready(function()
        {
            // initialize datatable
            $('#dt-basic-example').dataTable(
                {
                    responsive: true,
                });
        });

        function saveInHome(el) {
            let product_id = $(el).data('id');
            let is_checked = $(el).is(':checked');
            $.ajax({
                method:'post',
                url:"{{route('admin.update.inHome')}}",
                data:{
                    product_id : product_id,
                    is_checked : is_checked
                },
                success:function (response){
                    success("Prodotto aggiornato",true);
                }
            })
        }

        function deleteProduct(el) {
            let product_id = $(el).data('id');
            $.ajax({
                method:'post',
                url:"{{route('admin.delete.product')}}",
                data:{
                    product_id : product_id
                },
                success:function (response){
                    success("Prodotto eliminato correttamente",true);
                }
            })
        }

        function showMore(el) {
            let product_id = $(el).data('id');
            $.ajax({
                method:'post',
                url:"{{route('admin.detail.product')}}",
                data:{
                    product_id : product_id
                },
                success:function (response){
                    let html = '';
                    html += '<tr>';
                    html += '<td>' + response[0].id + '</td>';
                    html += '<td>' + response[0].name + '</td>';
                    html += '<td>' + response[0].description + '</td>';
                    html += '<td>' + response[0].category + '</td>';
                    html += '<td><input id="quantity_' + response[0].id + '" value="' + response[0].quantity +'" class="form-control" type="number"></td>';
                    html += '<td><input id="price_' + response[0].id + '"value="' + response[0].price +'" class="form-control" type="number"></td>';
                    html += '<td><input id="weight_' + response[0].id + '"value="' + response[0].weight +'" class="form-control" type="number"></td>';
                    html += '<td>' + response[0].created_at + '</td>';
                    html += '<td>' + response[0].updated_at + '</td>';
                    html += '<td><button class="btn btn-danger" data-id="'+ response[0].id + '" onclick="editVariation(this)">Salva</button></td>';
                    html += '</tr>';
                    $('#product_detail').html(html);
                    $('#show_product_detail').show();
                }
            })
        }

        function editVariation(el){
            let item_id = $(el).data('id');
            $.ajax({
                method:'post',
                url:"{{route('admin.post.single.product.edit')}}",
                data:{
                    item_id : item_id,
                    item_qta : $('#quantity_' + item_id).val(),
                    item_price : $('#price_' + item_id).val(),
                    item_weight: $('#weight_' + item_id).val()
                },
                success:function (response){
                    success("Modifiche apportate correttamente", false);

                }
            })
        }
    </script>
@endsection
