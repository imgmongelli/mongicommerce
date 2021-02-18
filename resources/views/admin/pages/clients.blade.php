@extends('mongicommerce::admin.template.layout')
@section('title','Clienti')
@section('title_icon',"fa-users")
@section('subtitle','i tuoi clienti')
@section('description','Lista dei tuoi clienti')
@section('css')
<link rel="stylesheet" media="screen, print" href="{{css('datagrid/datatables/datatables.bundle.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
<table id="clients" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>id</th>
            <th>Nome</th>
            <th>Provincia</th>
            <th>Citta</th>
            <th>Indirizzo</th>
            <th>Cap</th>
            <th>email</th>
            <th>telefono</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{$client->id}}</td>
            <td>{{$client->first_name}} {{$client->last_name}}</td>
            <td>{{$client->province}}</td>
            <td>{{$client->city}}</td>
            <td>{{$client->address}}</td>
            <td>{{$client->cap}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->telephone}}</td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
@section('js')
<script src="{{js('datagrid/datatables/datatables.bundle.js')}}"></script>
<script>
    $(document).ready(function()
        {
            // initialize datatable
            $('#clients').dataTable(
                {
                    responsive: true,
                });
        });
</script>
@endsection
