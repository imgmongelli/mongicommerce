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
@endsection
@section('js')

@endsection
