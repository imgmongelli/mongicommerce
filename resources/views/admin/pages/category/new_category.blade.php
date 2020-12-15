@extends('mongicommerce::admin.template.layout')
@section('title','Crea una nuova categoria')
@section('subtitle','')
@section('description','In questa sezione puoi creare una nuova cateogoria')
@section('css')
    <link rel="stylesheet" href="{{css('jstree/themes/default/style.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Crea una nuova categoria
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
                        <div class="form-group">
                            <label class="form-label" for="input-group-lg-size">Nome categoria</label>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                                        <span class="input-group-text py-1 px-3">
                                                            <span class="icon-stack">
                                                               <i class="fal fa-tag"></i>
                                                            </span>
                                                        </span>
                                </div>
                                <input id="input-group-lg-size" type="text" class="form-control" placeholder=""
                                       aria-describedby="input-group-lg-size">
                            </div>
                            <span class="help-block">Some help content goes here</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="input-group-lg-size">Sotto categoria</label>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                                        <span class="input-group-text py-1 px-3">
                                                            <span class="icon-stack">
                                                               <i class="fal fa-tag"></i>
                                                            </span>
                                                        </span>
                                </div>
                                <select id="input-group-lg-size" type="text" class="form-control"
                                        aria-describedby="input-group-lg-size">
                                    <option value="">Seleziona</option>
                                </select>
                            </div>
                            <span class="help-block">Some help content goes here</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="input-group-lg-size-2">Descrizione</label>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fal fa-pen"></i>
                                    </span>
                                </div>
                                <textarea name="" id="input-group-lg-size-2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div id="panel-3" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Struttura
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
                        <div id="trtrtr" class="demo"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{js('jstree/jstree.js')}}"></script>
    <script>
        $(function () {
            $('#trtrtr').jstree({
                'core': {
                    'data': [
                        {
                            "text": "Root node",
                            "state": {"opened": true},
                            "children": [
                                {
                                    "text": "Child node 1",
                                    "state": {"selected": false},
                                },
                                {
                                    "text": "Child node 2",
                                    "state": {"disabled": false}
                                }
                            ]
                        }
                    ]
                }
            });

        });

    </script>
@endsection
