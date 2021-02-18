@extends('mongicommerce::admin.template.layout')
@section('title','Lista Ordini')
@section('title_icon',"fa-shopping-cart")
@section('subtitle','')
@section('description','Mostra lista dei prodotti inseriti')
@section('css')
<link rel="stylesheet" media="screen, print" href="{{css('datagrid/datatables/datatables.bundle.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Lista prodotti
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10"
                        data-original-title="Collapse"></button>
                    <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"
                        data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <!-- datatable start -->
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead>
                            <tr>
                                <th>ID ordine</th>
                                <th>Creato</th>
                                <th>Cliente</th>
                                <th>Prezzo</th>
                                <th>Prezzo Spedizione</th>
                                <th>Ritiro In Negozio</th>
                                <th>Note</th>
                                <th>Stato</th>
                                <th>Pagato con</th>
                                <th>Azioni</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                                <td>
                                    <a href="#">{{$order->user->first_name}}
                                        {{$order->user->last_name}}</a>
                                </td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->shipping_price}}</td>
                                <td>{!! $order->pick_up_in_shop == true ? '<i style="color:green;" class="fal fa-check"
                                        aria-hidden="true"></i>' : '<i style="color:red;" class="fal fa-times"
                                        aria-hidden="true"></i>' !!}
                                </td>
                                <td>{{$order->note_delivery}}</td>
                                <td>
                                    <select onchange="changeStatus(this,{{$order->id}})" class="form-control" name=""
                                        id="">
                                        @foreach($statuses as $status)
                                        <option {{$status->id == $order->status_id ? 'selected':''}}
                                            value="{{$status->id}}">
                                            {{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{{$order->typePayment->name}}</td>
                                <td>
                                    <a href="{{route('admin.order',$order->id)}}" class="btn btn-primary">Dettagli</a>
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
<script src="{{js('datagrid/datatables/datatables.bundle.js')}}"></script>
<script>
    $(document).ready(function()
        {
            // initialize datatable
            $('#dt-basic-example').dataTable(
                {
                    responsive: true,
                });
        });
</script>
@endsection
