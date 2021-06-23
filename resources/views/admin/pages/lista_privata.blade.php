@extends('mongicommerce::admin.template.layout')
@section('title','Lista privata')
@section('title_icon',"fa-tags")
@section('subtitle','Crea la tua lista')
@section('description','Lista privata')
@section('css')
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
                                    <td><input class="product-list" data-id="{{$product->id}}" type="checkbox"></td>
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
<div class="row mt-5">
    <div class="col-md-12">
        <input type="text" class="form-control" id="list_name">
        <button class="btn btn-primary btn-block" onclick="saveList()">Crea lista</button>
    </div>
</div>
<div class="row mt-5">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Liste private
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
                            <th>Azioni</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $list)
                            <tr>
                                <td>{{$list->id}}</td>
                                <td>{{$list->name}}</td>
                                <td>
                                    <button data-id="{{$list->id}}" onclick="deleteList(this)" class="btn btn-danger">Elimina</button>
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
<script>
    function saveList(){
        let arrayList = [];
        $('.product-list').each(function (index, el){
            if($(el).is(':checked')){
                arrayList.push($(el).data('id'));
            }
        })
        $.ajax({
            method:'post',
            url:"{{route('admin.create.private.list')}}",
            data:{
                products : arrayList,
                list_name : $('#list_name').val()
            },
            success:function (response){
                success("Lista creata correttamente",true);
            }
        })
    }
    function deleteList(el){
        let list_id = $(el).data('id');
        $.ajax({
            method:'post',
            url:"{{route('admin.delete.list')}}",
            data:{
                list_id : list_id
            },
            success:function (response){
                success("Lista eliminato correttamente",true);
            }
        })
    }
</script>
@endsection
