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
                                <th>Nascondi</th>
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
                                    <td><input data-id="{{$product->id}}" type="checkbox" {!! $product->is_reserved == true ? 'checked':'' !!} onclick="reserve(this)"></td>
                                    <td>
                                        <div class="d-flex flex-column justify-content-center">
                                            @if($product->single_product)
                                                <button data-id="{{$product->id}}" onclick="deleteSingleProduct(this)" class="btn btn-danger" style="margin: 2px">Elimina</button>
                                                <a href="{{route('admin.single.product.edit', $product->id)}}" class="btn btn-secondary" style="margin: 2px">Modifica</a>
                                            @else
                                                <button data-id="{{$product->id}}" onclick="deleteVariationProduct(this)" class="btn btn-danger" style="margin: 2px">Elimina</button>
                                                <a href="{{route('admin.product.variation.edit', $product->id)}}" class="btn btn-secondary" style="margin: 2px">Modifica</a>
                                                <a href="{{route('admin.product.new.variante', $product->id)}}" class="btn btn-warning" style="margin: 2px">Varianti</a>
                                            @endif
                                        </div>

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


    <div id="delete-product-modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminazione prodotto con varianti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Sei sicuro di voler eliminare il prodotto e <strong>tutte</strong> le sue varianti?</p>
                    <input hidden id="input-product-id" type="text">
                </div>
                <div class="modal-footer">
                    <button id="confirm-button" type="button" class="btn btn-primary">Conferma</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
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
                    success("Prodotto aggiornato", false);
                }
            })
        }

        function reserve(el) {
            let product_id = $(el).data('id');
            let is_checked = $(el).is(':checked');
            $.ajax({
                method:'post',
                url:"{{route('admin.update.reserve')}}",
                data:{
                    product_id : product_id,
                    is_checked : is_checked
                },
                success:function (response){
                    success("Prodotto aggiornato", false);
                }
            })
        }

        function deleteSingleProduct(el) {
            let product_id = $(el).data('id');
            $.ajax({
                method:'post',
                url:"{{route('admin.delete.single.product')}}",
                data:{
                    product_id : product_id
                },
                success:function (response){
                    success("Prodotto eliminato correttamente",true);
                }
            })
        }

        function deleteVariationProduct(el) {
           $('#input-product-id').val($(el).data('id'));
            $('#delete-product-modal').modal('show');
        }

        $('#confirm-button').click(function () {
            let product_id = $('#input-product-id').val();
            $.ajax({
                method: 'post',
                url: "{{route('admin.delete.all.variations.product')}}",
                data: {
                    product_id: product_id
                },
                success: function (response) {
                    $('#delete-product-modal').modal('hide');
                    success("Prodotto eliminato correttamente", true);
                }
            })
        })

    </script>
@endsection
