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
                            Add the relative form sizing classes to the <code>.input-group</code> itself and contents
                            within will automatically resize—no need for repeating the form control size classes on each
                            element. <strong>Sizing on the individual input group elements isn’t supported</strong>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome categoria</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-tag"></i>
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

    <div class="row">
        <div class="col-md-12">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Tipo dettaglio
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
                            Add the relative form sizing classes to the <code>.input-group</code> itself and contents
                            within will automatically resize—no need for repeating the form control size classes on each
                            element. <strong>Sizing on the individual input group elements isn’t supported</strong>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Nome campo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-1 px-3">
                                                <span class="icon-stack">
                                                   <i class="fal fa-tag"></i>
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
                                                   <i class="fal fa-tag"></i>
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
                        <div id="div_values" style="display:none;" class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Valore tipo dettaglio</label>
                                    <div class="input-group">
                                        <select multiple="multiple" class="form-control js-example-basic-single" name="values_type" id="values_type"> </select>
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

@endsection
@section('js')
    <script src="{{js('formplugins/select2/select2.bundle.js')}}"></script>
    <script>
        let url_get_categories = '{{route('admin.post.get.categories')}}';
        $('.js-example-basic-single').select2({
            tags: true,
            tokenSeparators: [",", " "],
            placeholder: 'Inserisi i valori'
        });
        $(function () {
            getCategories();
        });

        $('#type').change(function () {
            let value = $(this).val();
            if(value === 'select' || value === 'checkbox' || value === 'radio'){
                $('#div_values').show();
            }else{
                $('#div_values').hide();
            }
        });
        function getCategories() {
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

        function saveDetails() {
            let url = '{{route('admin.post.create.detail')}}';
                    $.ajax({
                        method:'POST',
                        url: url,
                        data : {
                            category : $('#categories').val(),
                            name : $('#name_detail').val(),
                            type: $('#type').val(),
                            values : $('#values_type').val()
                        },
                        'statusCode': {
                            422: function (response) {
                                error422(response);
                            }
                        },
                        success:function (response) {
                                success('Dettaglio creato con successo',true);
                        }
                    });
        }
    </script>
@endsection
