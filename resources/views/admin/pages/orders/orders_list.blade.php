@extends('mongicommerce::admin.template.layout')
@section('title','Lista Ordini')
@section('title_icon',"fa-shopping-cart")
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
                                <th>Azioni</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->created_at->format('d/m/Y')}}</td>
                                    <td>{{$product->updated_at->format('d/m/Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.product.new.variante',$product->id)}}" class="btn btn-danger">Varianti</a>
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
    </script>
@endsection
