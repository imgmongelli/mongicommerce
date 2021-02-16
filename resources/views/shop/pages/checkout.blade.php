@extends('mongicommerce.template.layout')
@section('title','checkout')
@section('description','Dettagli di spedizione')
@section('css')
@endsection

@section('content')
<!-- Section -->
<div class="container-fluid white section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-push-2">
                <hr class="space-40" />
                <p class="centred">Note sul tuo ordine, ad es. note speciali per la consegna.</p>
                <hr class="space-40" />
                <textarea id="note_delivery" placeholder="Note per la spedizione"
                    class="form-control">{{$note}}</textarea>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-sm-push-2">
                <header class="centred">
                    <h1>Oppure</h1>
                </header>
                <div class="row mt-3">
                    <div class="col-md-1">
                        <input id="get_in_shop_checkbox" {{$delivery_where == 'true' ? 'checked':''}} type="checkbox">
                    </div>
                    <div class="col-md-11">
                        <p>Voglio ritirare in negozio</p>
                    </div>
                </div>


                <hr class="space-40" />
                <div class="row">
                    <div class="col-sm-12 btn-wrap">
                        <button onclick="saveDetails()" class="btn btn-default">Continua</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    function saveDetails() {
            let url_save_cache_details_order = "{{route('save_cache_details_order')}}";
            $.ajax({
                method:'POST',
                url:url_save_cache_details_order,
                data: {
                    note_delivery: $('#note_delivery').val(),
                    get_in_shop_checkbox: $('#get_in_shop_checkbox').is(":checked")
                },
                success:function (response) {
                    window.location.href = response.link;
                }
            })
        }
</script>
@endsection
