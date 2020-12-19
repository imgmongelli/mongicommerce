@extends('mongicommerce::admin.template.layout')
@section('title',"Gestione Dettagli")
@section('title_icon',"fa-list")
@section('subtitle','')
@section('description','In questa sezione puoi associare i dettagli ad ogni categoria')
@section('css')
    <link rel="stylesheet" media="screen, print" href="{{css('formplugins/select2/select2.bundle.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Crea un nuovo dettaglio
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
                        <div class="panel-tag">
                            Selezionando la categoria potrai visualizzare i <code>dettagli</code> già creati in precedenza,
                            e poter impostare con il bottone <code>Crea dettaglio</code> nuovi dettagli.
                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="whole_div_details" style="display: none;" class="row">
        <div class="col-md-12">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Campi dettagli
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content" id="div_details">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="whole_div_configuration_field" style="display: none;" class="row">
        <div class="col-md-12">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Campi specifiche
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content" id="div_configuration_field">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Dettagli
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome campo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-comment-edit"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="name_detail">
                                    </div>
                                    <span class="help-block">Nome del campo </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tipo dettaglio</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-brackets-curly"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <select class="form-control" name="type" id="type">
                                            <option value="">Seleziona</option>
                                            @foreach($types as $k => $type)
                                                <option value="{{$k}}">{{$k}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="help-block">Nome del campo </span>
                                </div>
                            </div>
                        </div>
                        <div id="div_values"  class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Valore tipo dettaglio</label>
                                    <div class="input-group">
                                        <select multiple="multiple" class="form-control js-example-basic-single"
                                                name="values_type" id="values_type"> </select>
                                    </div>
                                    <span class="help-block">Valori per l'elemento scelto</span>
                                </div>
                            </div>
                        </div>

                        <button onclick="saveDetails()" class="btn btn-primary mt-3">Crea dettaglio</button>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-md-12">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Specifiche
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name_configuration">Nome campo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-comment-edit"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" id="name_configuration">
                                    </div>
                                    <span class="help-block">Nome del campo </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Tipo specifica</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-brackets-curly"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <select class="form-control" name="type_configuration" id="type_configuration">
                                            <option value="">Seleziona</option>
                                            @foreach($configuration_field as $k => $field)
                                                <option value="{{$k}}">{{$k}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="help-block">Nome del campo </span>
                                </div>
                            </div>
                        </div>
                        <button onclick="saveConfigurationField()" class="btn btn-primary mt-3">Crea specifica</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')
    <script src="{{js('formplugins/select2/select2.bundle.js')}}"></script>
    <script>

        $('.js-example-basic-single').select2({
            tags: true,
            tokenSeparators: [","],
            placeholder: 'Valori'
        });
        $(function () {
            getCategories();
        });

        $('#categories').change(function () {
            getDetails();
            getConfigurationField();
        });


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

        function saveDetails() {
            let url = '{{route('admin.post.create.detail')}}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    category: $('#categories').val(),
                    name: $('#name_detail').val(),
                    type: $('#type').val(),
                    values: $('#values_type').val()
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    getDetails();
                    $('#name_detail').val('');
                    success('Dettaglio creato con successo', false);
                }
            });
        }

        function saveConfigurationField() {
            let url = '{{route('admin.post.create.configuration')}}';
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    category: $('#categories').val(),
                    name: $('#name_configuration').val(),
                    type: $('#type_configuration').val(),
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    getConfigurationField();
                    $('#name_configuration').val('');
                    success('Campo configurazione creato con successo', false);
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
                $('#whole_div_details').show();
            } else {
                $('#whole_div_details').hide();
            }
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
                $('#div_configuration_field').html(html);
                $('#whole_div_configuration_field').show();
            } else {
                $('#whole_div_configuration_field').hide();
            }
        }
    </script>
@endsection
