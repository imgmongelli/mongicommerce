@extends('mongicommerce::admin.template.layout')
@section('title','Lista privata')
@section('title_icon',"fa-tags")
@section('subtitle','Crea la tua lista')
@section('description','Lista privata')
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
                                <th>Solo per lista</th>
                                <th>Aggiungi</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td style="text-align: justify">{{Str::limit($product->description, 300)}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td><input class="product-list-reserved" id="reserved_{{$product->id}}" type="checkbox" onclick="addReservedToSession({{$product->id}})"></td>
                                    <td><input class="product-list" id="add_{{$product->id}}" type="checkbox" onclick="addItemToSession({{$product->id}})"></td>
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
        <div class="form-group">
            <label class="form-label" for="name">Nome lista</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text py-1 px-3">
                        <span class="icon-stack">
                           <i class="fal fa-comment-edit"></i>
                        </span>
                    </span>
                </div>
                <input type="text" class="form-control" id="list_name">
            </div>
        </div>
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
                            <th>Nome lista</th>
                            <th>Link lista</th>
                            <th>Azioni</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lists as $list)
                            <tr>
                                <td>{{$list->id}}</td>
                                <td>{{$list->name}}</td>
                                <td>
                                    <div class="d-flex justify-content-around">
                                        <input type="text" class="form-control mr-2" id="list_link_{{$list->id}}" value="{{route('shop.private.list', $list->id_list)}}" readonly>
                                        <button data-id="{{$list->id}}" onclick="copyLink(this)" class="btn btn-primary">Copia!</button>
                                    </div>

                                </td>
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
<script src="{{js('datagrid/datatables/datatables.bundle.js')}}"></script>
<script>

    $(document).ready(function()
    {
        // initialize datatable
        $('#dt-basic-example').dataTable(
            {
                responsive: true,
            });
        sessionStorage.removeItem('arrayList');
        sessionStorage.removeItem('arrayReserved');
    });

    function addItemToSession(productId){
        let arrayList = sessionStorage.getItem('arrayList') ? JSON.parse(sessionStorage.getItem('arrayList')) : [];

        const index = arrayList.indexOf(productId);
        if (index > -1) {
            arrayList.splice(index, 1);
        }

        if($('#add_' + productId).is(':checked')){
            arrayList.push(productId);
        }

        sessionStorage.setItem('arrayList', JSON.stringify(arrayList));
    }

    function addReservedToSession(productId){
        let arrayReserved = sessionStorage.getItem('arrayReserved') ? JSON.parse(sessionStorage.getItem('arrayReserved')) : [];

        const index = arrayReserved.indexOf(productId);
        if (index > -1) {
            arrayReserved.splice(index, 1);
        }

        if($('#reserved_' + productId).is(':checked')){
            arrayReserved.push(productId);
        }

        sessionStorage.setItem('arrayReserved', JSON.stringify(arrayReserved));
    }

    function saveList(){
        // let arrayList = [];
        // $('.product-list').each(function (index, el){
        //     if($(el).is(':checked')){
        //         arrayList.push($(el).data('id'));
        //     }
        // })
        // let arrayReserved = [];
        // $('.product-list-reserved').each(function (index, el){
        //     if($(el).is(':checked')){
        //         arrayReserved.push($(el).data('id'));
        //     }
        // })
        let arrayList = sessionStorage.getItem('arrayList') ? JSON.parse(sessionStorage.getItem('arrayList')) : [];
        let arrayReserved = sessionStorage.getItem('arrayReserved') ? JSON.parse(sessionStorage.getItem('arrayReserved')) : [];
        $.ajax({
            method:'post',
            url:"{{route('admin.create.private.list')}}",
            data:{
                products : arrayList,
                reserved : arrayReserved,
                list_name : $('#list_name').val()
            },
            success:function (response){
                // console.log(response);
                success("Lista creata correttamente", true);
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
                success("Lista eliminata correttamente", true);
            }
        })
    }

    function copyLink(el){
        let list_id = $(el).data('id');
        let input_id = "list_link_"+list_id;
        let copyText = document.getElementById(input_id);
        copyText.select();
        document.execCommand("copy");
    }
</script>
@endsection
