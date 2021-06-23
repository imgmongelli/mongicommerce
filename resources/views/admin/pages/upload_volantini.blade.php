@extends('mongicommerce::admin.template.layout')
@section('title','Volantini')
@section('title_icon',"fa-tags")
@section('subtitle','Carica i tuoi volantini')
@section('description','Qui puoi caricare i tuoi volantini')
@section('css')
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <label for="">Nome volantino</label>
                    <input class="form-control" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">File *pdf</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile04">
                            <label class="custom-file-label" for="inputGroupFile04">Scegli file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Carica volantino</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="row mt-5">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Lista volantini
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
                                <th>Nome Volantino</th>
                                <th>Creato</th>
                                <th>Modificato</th>
                                <th>Azioni</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($volantini as $volantino)
                                <tr>
                                    <td>{{$volantino->id}}</td>
                                    <td>{{$volantino->name}}</td>
                                    <td>{{$product->created_at->format('d/m/Y')}}</td>
                                    <td>{{$product->updated_at->format('d/m/Y')}}</td>
                                    <td>
                                        <button data-id="{{$volantino->id}}" onclick="deleteVolantino(this)" class="btn btn-danger">Elimina</button>
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
    function deleteVolantino(el) {
        let volantino_id = $(el).data('id');
        $.ajax({
            method:'post',
            url:"{{route('admin.delete.volantino')}}",
            data:{
                volantino_id : volantino_id
            },
            success:function (response){
                success("Volantino eliminato correttamente",true);
            }
        })
    }
</script>

@endsection
