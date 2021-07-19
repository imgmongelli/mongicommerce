@extends('mongicommerce.template.layout')
@section('title','Login')
@section('description','Accedi allo store')
@section('css')
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 mt-5 mb-5">
             <fieldset>
                <legend>EFFETTUA IL LOGIN</legend>
                <form method="POST" action="{{ route('shop.redirect.login') }}">
                    @csrf
                    <!-- Text input-->
                    <div class="form-group">
                        <label for="inputAddress">EMAIL</label>
                        <input id="email" placeholder="Email" type="email"
                            class="form-control email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                            required autocomplete="email" autofocus>
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
                    <button type="submit" class="btn btn-primary btn-block">Accedi</button>
                    <div class="mt-2">
                        <p>Sei un nuovo utente?<a href="{{route('shop.register')}}" class="custom-link"> Registrati</a></p>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection
