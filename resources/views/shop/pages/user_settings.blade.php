@extends('mongicommerce.template.layout')
@section('title','I tuoi dati di spedizione')
@section('description','')
@section('css')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 mb-5 card" style="padding: 15px">
                <fieldset>
                    <legend>DETTAGLI ACCOUNT</legend>
                    <!-- Text input-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">P.IVA</label>
                            <input type="text" class="form-control" value="{{$piva}}" id="piva">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">NOME AZIENDA</label>
                            <input type="text" value="{{$rag_soc}}" class="form-control" id="rag_soc">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4">CODICE FATTURAZIONE ELETTRONICA</label>
                            <input type="text" value="{{$ipa}}" class="form-control" id="ipa">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="first_name">NOME</label>
                            <input type="text" value="{{$first_name}}" class="form-control" id="first_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">COGNOME</label>
                            <input type="text" value="{{$last_name}}" class="form-control" id="last_name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="last_name">CODICE FISCALE</label>
                            <input type="text" value="{{$cf}}" class="form-control" id="cf">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email_sped">EMAIL</label>
                        <input type="text" value="{{$email_sped}}" class="form-control" id="email_sped">
                    </div>
                    <div class="form-group">
                        <label for="telephone">TELEFONO</label>
                        <input type="text" value="{{$telephone}}" class="form-control" id="telephone">
                    </div>
                    <hr>
                    <legend>DETTAGLI SPEDIZIONE</legend>
                    <div class="form-group">
                        <label for="address">INDIRIZZO</label>
                        <textarea class="form-control" id="address">{{$address}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="floor">PIANO/SCALA O ALTRO</label>
                        <textarea name="floor" id="floor" class="form-control">{{$floor}}</textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="province">PROVINCIA</label>
                            <input type="text" value="{{$province}}" class="form-control" id="province">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="city">CITTA</label>
                            <input type="text" value="{{$city}}" class="form-control" id="city">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="cap">CAP</label>
                            <input type="text" value="{{$cap}}" class="form-control" id="cap">
                        </div>
                    </div>
                    <hr>
                    <button id="save_user_settings" class="btn btn-primary btn-block">Modifica</button>
                    <hr>
                </fieldset>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#save_user_settings').click(function (){
            $.ajax({
                method:'post',
                url:"{{route('shop.user.settings.edit')}}",
                data:{
                    piva : $('#piva').val(),
                    rag_sociale : $('#rag_soc').val(),
                    ipa : $('#ipa').val(),
                    first_name : $('#first_name').val(),
                    last_name : $('#last_name').val(),
                    cf : $('#cf').val(),
                    email : $('#email_sped').val(),
                    telephone : $('#telephone').val(),
                    address : $('#address').val(),
                    floor : $('#floor').val(),
                    province : $('#province').val(),
                    city : $('#city').val(),
                    cap : $('#cap').val()
                },
                'statusCode': {
                    422: function (response) {
                        //get first error to show it on top of pagse
                        error422(response);
                    }
                },
                success:function (response){
                    success("Impostazioni modificate correttamente",true);
                }
            })
        })
    </script>
@endsection
