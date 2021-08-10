@extends('mongicommerce::admin.template.layout')
@section('title','Valida gift card')
@section('title_icon',"fa-tags")
@section('subtitle','')
@section('description','In questa sezione puoi validare gift card o buoni regalo')
@section('css')
@endsection
@section('subheader')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Per verificare la validità di una gift card inserisci il codice
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

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="name">Codice gift card</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-gift-card width-1 text-align-center"></i></span>
                                    </div>
                                    <input type="text" value="" id="gift_card_code" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" onclick="giftValidation()">Utilizza</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" id="gift_card_information" style="display: none">
        <div class="panel">
            <div class="panel-hdr">
                <h2>
                    Informazioni Gift Card
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                            data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                            data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content" id="gift_card_fields">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        function giftValidation(){
            $.ajax({
                method:'post',
                url:"{{route('admin.post.gift.validation')}}",
                data:{
                    gift_card_code : $('#gift_card_code').val(),
                },
                'statusCode': {
                    422: function (response) {
                        error422(response);
                    }
                },
                success:function (response){
                    if(response.error != undefined){
                        error(response.error);
                    }else{
                        generateGiftFields(response[0]);
                    }
                }
            })
        }

        function generateGiftFields(giftInfo) {
            let html = '';
            //name
            html += '<div class="row">';
            html += '<div class="col-md-6">';
            html += '<div class="form-group">';
            html += '<label class="form-label" for="name">Nome gift card</label>';
            html += '<input type="text" value="' + giftInfo.name + '" id="gift_card_code" class="form-control" disabled>';
            html += '</div>';
            html += '</div>';
            //price
            html += '<div class="col-md-6">';
            html += '<div class="form-group">';
            html += '<label class="form-label" for="name">Valore gift card</label>';
            html += '<input type="text" value="€ ' + giftInfo.price + '" id="gift_card_code" class="form-control" disabled>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            //duration
            html += '<div class="row mt-2">';
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label class="form-label" for="name">Durata gift card</label>';
            html += '<input type="text" value="' + giftInfo.duration + ' giorni" id="gift_card_code" class="form-control" disabled>';
            html += '</div>';
            html += '</div>';
            //bought the
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label class="form-label" for="name">Data di acquisto</label>';
            html += '<input type="text" value="' + giftInfo.bought_the + '" id="gift_card_code" class="form-control" disabled>';
            html += '</div>';
            html += '</div>';
            //expiration date
            html += '<div class="col-md-4">';
            html += '<div class="form-group">';
            html += '<label class="form-label" for="name">Data di scadenza</label>';
            html += '<input type="text" value="' + giftInfo.expiration_date + '" id="gift_card_code" class="form-control" disabled>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            //validation
            html += '<hr>';
            html += '<div class="row mt-2">';
            html += '<div class="col-md-12 d-flex justify-content-center align-items-center">';
            if(giftInfo.is_valid){
                html += '<h1 style="color:green">' + giftInfo.message + '</h1>';
            }else{
                html += '<h1 style="color:red">' + giftInfo.message + '</h1>';
            }
            html += '</div>';
            html += '</div>';
            html += '<hr>';
            $('#gift_card_fields').html(html);
            $('#gift_card_information').show();

        }
    </script>
@endsection
