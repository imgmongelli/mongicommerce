@extends('mongicommerce::admin.template.layout')
@section('title','Dashboard')
@section('subtitle','Sotto titolo')
@section('description','Questa è una breve descrizione')
@section('css')
<link rel="stylesheet" media="screen, print" href="{{css('datagrid/datatables/datatables.bundle.css')}}">
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-warning-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{$current_orders}}
                        <small class="m-0 l-h-n">Ordini in corso</small>
                    </h3>
                </div>
                <i class="fal fa-gem position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-success-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{$completed_orders}}
                        <small class="m-0 l-h-n">Ordini completati</small>
                    </h3>
                </div>
                <i class="fal fa-lightbulb position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-info-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{$products_number}}
                        <small class="m-0 l-h-n">Prodotti presenti</small>
                    </h3>
                </div>
                <i class="fal fa-globe position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
{{--        <div class="col-xl-6">--}}
{{--            <div id="panel-1" class="panel">--}}
{{--                <div class="panel-hdr">--}}
{{--                    <h2>--}}
{{--                        Panel <span class="fw-300"><i>Title</i></span>--}}
{{--                    </h2>--}}
{{--                    <div class="panel-toolbar">--}}
{{--                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"--}}
{{--                                data-offset="0,10" data-original-title="Collapse"></button>--}}
{{--                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"--}}
{{--                                data-offset="0,10" data-original-title="Fullscreen"></button>--}}
{{--                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip"--}}
{{--                                data-offset="0,10" data-original-title="Close"></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="panel-container show">--}}
{{--                    <div class="panel-content">--}}
{{--                        <div class="panel-tag">--}}
{{--                            It stash and was even had of collection the latest story still every or times--}}
{{--                            derive come way. Travelling business ill. Helplessly starting didn't should he--}}
{{--                            her bad will so through audiences to the supported congress, if card with was--}}
{{--                            way allows century quarter the control village for of payload.--}}
{{--                        </div>--}}
{{--                        <p>Offers it children. Been far good the or so eye. And first the her to white--}}
{{--                            unionized that the absolutely supplies hall to named accuse times had or the to--}}
{{--                            in the monitor a by carefully and than train excessive turned been a rationale--}}
{{--                            to be the little. Agency still a the supported or people out doing place what--}}
{{--                            does one studies of that value designer the you line their transformed extent,--}}
{{--                            you to for not must reflection chequered with got rush than because he with--}}
{{--                            thoughts until sisters term much and bed they of duty organization. And ago.--}}
{{--                            As.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-12">--}}
{{--            <div id="panel-1" class="panel">--}}
{{--                <div class="panel-hdr">--}}
{{--                    <h2>--}}
{{--                        Panel <span class="fw-300"><i>Title</i></span>--}}
{{--                    </h2>--}}
{{--                    <div class="panel-toolbar">--}}
{{--                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip"--}}
{{--                                data-offset="0,10" data-original-title="Collapse"></button>--}}
{{--                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip"--}}
{{--                                data-offset="0,10" data-original-title="Fullscreen"></button>--}}
{{--                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip"--}}
{{--                                data-offset="0,10" data-original-title="Close"></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="panel-container show">--}}
{{--                    <div class="panel-content">--}}
{{--                        <div class="panel-tag">--}}
{{--                            It stash and was even had of collection the latest story still every or times--}}
{{--                            derive come way. Travelling business ill. Helplessly starting didn't should he--}}
{{--                            her bad will so through audiences to the supported congress, if card with was--}}
{{--                            way allows century quarter the control village for of payload.--}}
{{--                        </div>--}}
{{--                        <p>Offers it children. Been far good the or so eye. And first the her to white--}}
{{--                            unionized that the absolutely supplies hall to named accuse times had or the to--}}
{{--                            in the monitor a by carefully and than train excessive turned been a rationale--}}
{{--                            to be the little. Agency still a the supported or people out doing place what--}}
{{--                            does one studies of that value designer the you line their transformed extent,--}}
{{--                            you to for not must reflection chequered with got rush than because he with--}}
{{--                            thoughts until sisters term much and bed they of duty organization. And ago.--}}
{{--                            As.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Lista ordini
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
