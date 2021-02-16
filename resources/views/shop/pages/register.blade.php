@extends('mongicommerce.template.layout')
@section('title','Registrati')
@section('description','Puoi registrarti da qui')
@section('css')
@endsection

@section('content')

<form method="POST" action="{{ route('shop.register') }}">
    @csrf
    <!-- Text input-->
    <div class="form-group">
        <label for="first_name">NOME</label>
        <input id="first_name" placeholder="Nome" type="text" class="form-control first_name @error('first_name') is-invalid @enderror"
            name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
        @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="last_name">COGNOME</label>
        <input id="last_name" placeholder="Cognome" type="text" class="form-control last_name @error('last_name') is-invalid @enderror"
            name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
        @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
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
    <div class="form-group">
        <label for="password_confirmation">RIPETI PASSWORD</label>
        <input id="password_confirmation" placeholder="Password" type="password"
            class="form-control password_confirmation @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required
            autocomplete="current-password">
        @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Registrati</button>
</form>
@endsection
@section('js')
@endsection
