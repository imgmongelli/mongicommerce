@extends('mongicommerce.template.layout')
@section('title','pagamento')
@section('description',"Concludi l'ordine")
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <fieldset>
                <legend>EFFETTUA IL LOGIN</legend>
                <form method="POST" action="{{ route('login') }}">
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
                               class="form-control password @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </fieldset>
            <hr>
            <fieldset>
                <legend>INSERISCI I DATI DI SPEDIZIONE</legend>
                <!-- Text input-->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">P.IVA/CODICE FISCALE</label>
                        <input type="text" class="form-control" id="piva">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">NOME AZIENDA</label>
                        <input type="text" class="form-control" id="rag_soc">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">NOME</label>
                        <input type="text" class="form-control" id="first_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">COGNOME</label>
                        <input type="text" class="form-control" id="last_name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">INDIRIZZO</label>
                    <input type="text" class="form-control" id="inputAddress">
                </div>
                <div class="form-group">
                    <label for="email_sped">EMAIL</label>
                    <input type="text" class="form-control" id="email_sped">
                </div>
                <div class="form-group">
                    <label for="piano">PIANO/SCALA O ALTRO</label>
                    <textarea name="piano" id="piano" class="form-control"></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="prov">PROVINCIA</label>
                        <input type="text" class="form-control" id="prov">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">CITTA</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="cap">CAP</label>
                        <input type="text" class="form-control" id="cap">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <a class="btn btn-primary" href="{{route('shop.checkout')}}">Prosegui</a>
        </div>
    </div>
@endsection

@section('js')
@endsection
