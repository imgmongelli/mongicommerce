@extends('mongicommerce.template.layout')
@section('title','I tuoi ordini')
@section('description','Lista dei tuoi ordini')
@section('css')
@endsection
@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('error') }}</p>
        </div>
        @endif
        @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
@endsection
@section('js')
@endsection
