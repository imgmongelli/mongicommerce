@extends('mongicommerce::admin.template.layout')
@section('title','Crea un nuovo prodotto')
@section('title_icon',"fa-books")
@section('subtitle','per il tuo negozio online')
@section('description','Potrai inserire i prodotti che i clienti visualizzeranno nel tuo negozio online')
@section('css')
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Informazioni Base
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome prodotto</label>
                                    <input type="text" id="product_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Descrizione prodotto</label>
                                    <textarea name="" id="product_description" class="form-control"
                                              rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Seleziona categoria
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome categoria</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-tags"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <select class="form-control" name="categories" id="categories"></select>
                                    </div>
                                    <span class="help-block">Categoria da associare ai dettagli</span>
                                </div>
                            </div>
                            <button onclick="saveProduct()" class="mt-3 btn btn-primary btn-block">Crea prodotto</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        function getCategories() {
            let url_get_categories = '{{route('admin.post.get.categories')}}';
            $.ajax({
                method: 'POST',
                url: url_get_categories,
                data: {},
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    $('#categories').html('<option value="" selected>Seleziona</option>');
                    $.each(response, function (index, value) {
                        $('#categories').append($("<option />").val(value.id).text(value.name));
                    });
                }
            });
        }

        $(function () {
            getCategories();
        });

        function saveProduct() {
            let details = [];
            let url = '{{route('admin.post.product.new')}}';

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    product_name: $('#product_name').val(),
                    product_description: $('#product_description').val(),
                    category_id: $('#categories').val(),
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    let product_id = response.product_id;
                    let path = '{{route('admin.product.new.variante','')}}';
                    success("Prodotto inserito con successo! per inserire le varianti clicca <a href='"+path+"/"+product_id+"'>qui</a>");
                }
            });


        }
    </script>
@endsection
