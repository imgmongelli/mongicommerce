@extends('mongicommerce::admin.template.layout')
@section('title','Crea una nuova categoria')
@section('subtitle','')
@section('description','In questa sezione puoi creare una nuova cateogoria')
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
                       Crea una nuova categoria
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            Add the relative form sizing classes to the <code>.input-group</code> itself and contents within will automatically resize—no need for repeating the form control size classes on each element. <strong>Sizing on the individual input group elements isn’t supported</strong>
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
                                <input id="input-group-lg-size" type="text" class="form-control" placeholder="Large size" aria-describedby="input-group-lg-size">
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
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-4">
                <div class="w-100 bg-fusion-50 rounded-top"></div>
                <img src="{{img('card-backgrounds/cover-7-lg.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Nome Categoria</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <small class="text-muted">Last updated 3 mins ago</small>
                    <a href="#" class="btn btn-primary waves-effect waves-themed">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
