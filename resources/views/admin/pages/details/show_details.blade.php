@extends('mongicommerce::admin.template.layout')
@section('title',"Gestione Dettagli")
@section('title_icon',"fa-list")
@section('subtitle','')
@section('description','In questa sezione puoi associare i dettagli ad ogni categoria')
@section('css')

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
                        Campi per la categoria selezionata
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
@endsection
@section('js')
    <script>
        let url_get_categories = '{{route('admin.post.get.categories')}}';
        $(function () {
            getCategories();
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

        $('#categories').change(function () {
            let url = '{{route('admin.post.get.details')}}';
                    $.ajax({
                        method:'POST',
                        url: url,
                        data : {
                            category_id: $('#categories').val()
                        },
                        'statusCode': {
                            422: function (response) {
                            }
                        },
                        success:function (response) {
                            generateDetails(response);
                        }
                    });
        });

        function generateDetails(details) {
            let html = '';
            $.each(details,function (index,value) {
                html += '<div class="row">';
                html += '<div class="col-md-12">';
                html += '<div class="form-group">';
                html += '<label class="form-label" for="name">'+value.name+'</label>';
                html += value.html;
                html += '</div>';
                html += '</div>';
                html += '</div>';
            });
            $('#div_details').html(html);
        }

    </script>
@endsection
