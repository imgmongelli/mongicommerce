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
    </script>
@endsection
