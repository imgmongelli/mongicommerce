@extends('mongicommerce::admin.template.layout')
@section('title','Modifica specifiche prodotto')
@section('title_icon',"fa-tags")
@section('subtitle','')
@section('description','In questa sezione puoi modificare le specifiche del prodotto')
@section('css')
    <link rel="stylesheet" media="screen, print" href="{{css('formplugins/cropperjs/cropper.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{css('fa-solid.css')}}">
    <link rel="stylesheet" href="{{css('jstree/themes/default/style.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                @if($count > 0)
                    <div class="panel-hdr">
                        <h2>
                            Specifiche Prodotto
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">

                            <div class="panel-container show">
                                <div class="panel-content">
                                    <!-- datatable start -->
                                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                        <thead>
                                        <tr>
                                            <th>Nome Specifica</th>
                                            <th>Valore</th>
                                            <th>Salva</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($products_config_fields as $currProdConfFields)
                                            @foreach ($config_fields as $currConfFields)
                                                @if ($currProdConfFields->config_field_id == $currConfFields->id)
                                                    <tr>
                                                        <td>{{$currConfFields->name}}</td>
                                                        @if($currConfFields->type == "text")
                                                            <td><input id="prod_conf_fields_{{$currProdConfFields->id}}" value="{{$currProdConfFields->value}}" class="form-control" type="text" onchange="enableSaveButton({{$currProdConfFields->id}})"></td>
                                                        @endif
                                                        @if($currConfFields->type == "number")
                                                            <td><input id="prod_conf_fields_{{$currProdConfFields->id}}" value="{{$currProdConfFields->value}}" class="form-control" type="number" onchange="enableSaveButton({{$currProdConfFields->id}})"></td>
                                                        @endif
                                                        @if($currConfFields->type == "textarea")
                                                            <td><textarea id="prod_conf_fields_{{$currProdConfFields->id}}" value="{{$currProdConfFields->value}}" class="form-control" type="number" onchange="enableSaveButton({{$currProdConfFields->id}})"></textarea></td>
                                                        @endif
                                                            <td style="width: 10px"><button class="btn btn-primary" id = 'button_{{$currProdConfFields->id}}' style="float: right; margin-bottom: 10px" onclick="editSpecifiche({{$currProdConfFields->id}})"><i class="fal fa-save"></i></button></td>
                                                    </tr>
                                                    <label id="aaa"></label>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- datatable end -->
                                    <!--<button class="btn btn-primary" style="float: right; margin-bottom: 10px" data-id="1" onclick="editSpecifiche({{$currProdConfFields}})">SALVA</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="name"><b>Non sono presenti specifiche per il prodotto selezionato.</b></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script>

        function enableSaveButton(id) {
            $("#button_"+id).attr('disabled', false);
        }

        function editSpecifiche(id){
            $.ajax({
                method: 'post',
                url: "{{route('admin.specifica.save')}}",
                data: {
                    id: id,
                    value: $('#prod_conf_fields_' + id).val()
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success: function (response) {
                    $("#button_"+id).attr('disabled', true);
                    success("Specifica modificata con successo",false);
                }
            });
        }
    </script>
@endsection

