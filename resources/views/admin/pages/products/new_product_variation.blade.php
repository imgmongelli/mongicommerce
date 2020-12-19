@extends('mongicommerce::admin.template.layout')
@section('title','Crea una variante per il prodotto ')
@section('title_icon',"fa-shopping-cart")
@section('subtitle',$product->name)
@section('description',$product->description)
@section('css')
    <link rel="stylesheet" media="screen, print" href="{{css('datagrid/datatables/datatables.bundle.css')}}">
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
                                    <input type="text" value="{{$product->name}}" id="product_name" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Descrizione prodotto</label>
                                    <textarea name="" id="product_description" class="form-control"
                                              rows="10">{{$product->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Specifiche prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div id="div_configurarion_field" class="panel-content">

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
                                        <select class="form-control" disabled name="categories" id="categories"></select>
                                    </div>
                                    <span class="help-block">Categoria da associare ai dettagli</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-hdr">
                    <h2>
                        Dettagli prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Quantità</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-abacus"></i>
                                                </span>
                                            </span>
                                </div>
                                <input type="number" id="quantity" class="form-control">
                            </div>
                            <span class="help-block">Quantità per prodotti con questa varietà</span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Prezzo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-abacus"></i>
                                                </span>
                                            </span>
                                </div>
                                <input type="number" id="price" class="form-control">
                            </div>
                            <span class="help-block">Quantità per prodotti con questa varietà</span>
                        </div>
                    </div>
                    <div id="div_details" class="panel-content">

                    </div>
                    <button style=" width:90%;" onclick="saveProduct()" class="m-3 btn btn-primary">Crea prodotto
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Varianti per questo prodotto
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <!-- datatable start -->
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                            <thead>
                            <tr>
                                <th>Nome Prodotto</th>
                                <th>Descrizione Prodotto</th>
                                <th>Dettagli</th>
                                <th>Prezzo</th>
                                <th>Quantità</th>
                                <th>Azioni</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        @foreach($item->details as $detail)
                                            <span class="badge badge-danger">{{$detail->detail->value}}</span>
                                        @endforeach
                                    </td>
                                    <td><input value="{{$item->price}}" class="form-control" type="number"></td>
                                    <td><input value="{{$item->quantity}}" class="form-control" type="number"></td>
                                    <td><button class="btn btn-dark"><i class="fal fa-trash"></i></button></td>
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
        let product_id = '{{$product->id}}';
        let category_id = '{{$product->category_id}}';
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
                    $.each(response, function (index, value) {
                        if(category_id  == value.id){
                            $('#categories').append($("<option />").val(value.id).text(value.name));
                        }

                    });
                    getDetails();
                    getConfigurationField();
                }
            });
        }

        $(function () {
            getCategories();
        });


        function getDetails() {
            let url = '{{route('admin.post.get.details')}}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    category_id: $('#categories').val()
                },
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    generateDetails(response);
                }
            });
        }

        function generateDetails(details) {
            if (details.length > 0) {
                let html = '';
                $.each(details, function (index, value) {
                    html += '<div class="row mt-3">';
                    html += '<div class="col-md-12">';
                    html += '<div class="form-group">';
                    html += '<label class="form-label" for="name">' + value.name + '</label>';
                    html += value.html;
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });
                $('#div_details').html(html);
            } else {
                $('#div_details').html('');
            }

        }

        function getConfigurationField() {
            let url = '{{route('admin.post.get.configuration')}}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    category_id: $('#categories').val()
                },
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    generateConfigurationField(response);
                }
            });
        }

        function generateConfigurationField(details) {
            if (details.length > 0) {
                let html = '';
                $.each(details, function (index, value) {
                    html += '<div class="row mt-3">';
                    html += '<div class="col-md-12">';
                    html += '<div class="form-group">';
                    html += '<label class="form-label" for="name">' + value.name + '</label>';
                    html += value.html;
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                });
                $('#div_configurarion_field').html(html);
            } else {
                $('#div_configurarion_field').html('');
            }
        }

        function saveProduct() {
            let details = [];
            let url = '{{route('admin.post.product.variation.new')}}';
            $.each($('.mongifield'), function (index, value) {
                let detail_id = $(this).data('detail_id');
                let detail_value = $(this).val();
                if (detail_value !== '') {
                    details.push({'detail_id': detail_id, 'detail_value': detail_value});
                }
            });

            console.log(details);

            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    product_name: $('#product_name').val(),
                    product_description: $('#product_description').val(),
                    category_id: $('#categories').val(),
                    quantity: $('#quantity').val(),
                    price: $('#price').val(),
                    product_id : product_id,
                    details: JSON.stringify(details),
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    success("Nuova variante inserita con successo",true);
                }
            });

        }
    </script>
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
