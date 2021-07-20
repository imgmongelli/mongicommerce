@extends('mongicommerce.template.layout')
@section('title','Spedizione')
@section('description',"INSERISCI I DATI DI SPEDIZIONE")
@section('css')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-4">
            @auth
            @else
            <fieldset>
                <legend>EFFETTUA IL LOGIN</legend>
                <form method="POST" action="{{ route('shop.login') }}">
                    @csrf
                    <!-- Text input-->
                    <div class="form-group">
                        <label for="inputAddress">EMAIL</label>
                        <input id="email" placeholder="Email" type="email"
                            class="form-control email @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">PASSWORD</label>
                        <input id="password" placeholder="Password" type="password"
                            class="form-control password @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Accedi</button>
                    <div class="mt-2">
                        <p>Sei un nuovo utente?<a href="{{route('shop.register')}}" class="custom-link"> Registrati</a></p>
                    </div>
                </form>
            </fieldset>
            <hr>
            @endauth
            <fieldset>
                <legend>INSERISCI I DATI DI SPEDIZIONE</legend>
                <!-- Text input-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">P.IVA/CODICE FISCALE</label>
                        <input type="text" class="form-control" value="{{$piva}}" id="piva">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">NOME AZIENDA</label>
                        <input type="text" value="{{$rag_soc}}" class="form-control" id="rag_soc">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">NOME</label>
                        <input type="text" value="{{$first_name}}" class="form-control" id="first_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">COGNOME</label>
                        <input type="text" value="{{$last_name}}" class="form-control" id="last_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email_sped">EMAIL</label>
                    <input type="text" value="{{$email_sped}}" class="form-control" id="email_sped">
                </div>
                <div class="form-group">
                    <label for="address">INDIRIZZO</label>
                    <textarea  class="form-control" id="address">{{$address}}</textarea>
                </div>
                <div class="form-group">
                    <label for="floor">PIANO/SCALA O ALTRO</label>
                    <textarea name="floor" id="floor" class="form-control">{{$floor}}</textarea>
                </div>
                <div class="form-group">
                    <label for="telephone">TELEFONO</label>
                    <input type="text" value="{{$telephone}}" class="form-control" id="telephone">
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
                <button onclick="goToCheckout()" class="btn btn-primary btn-block">Prosegui</button>
                <hr>
            </fieldset>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function goToCheckout(){
        let urlgotocheckout = '{{route('shop.gotocheckout')}}';
        $.ajax({
            method:'POST',
            url:urlgotocheckout,
            'statusCode': {
            422: function (response) {
            //get first error to show it on top of pagse
                error422(response);
            }
            },
            data: {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                piva: $('#piva').val(),
                rag_soc: $('#rag_soc').val(),
                address: $('#address').val(),
                telephone: $('#telephone').val(),
                email_sped: $('#email_sped').val(),
                floor: $('#floor').val(),
                province: $('#province').val(),
                city: $('#city').val(),
                cap: $('#cap').val(),
            },
            success:function (response) {
                window.location.href = response.link;
            }
        })
    }

</script>
@endsection
