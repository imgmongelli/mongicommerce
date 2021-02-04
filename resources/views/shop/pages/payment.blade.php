@extends('mongicommerce.template.layout')
@section('title','pagamento')
@section('description',"Concludi l'ordine")
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <fieldset>
                <legend>INSERISCI I DATI DELLA TUA CARTA</legend>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">NUMERO DI CARTA</label>
                        <input type="text" class="form-control" id="piva">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">MESE SCADENZA</label>
                        <select class="form-control" name="" id="">
                            <option value="">-</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputPassword4">ANNO SCADENZA</label>
                        <select class="form-control" name="" id="">
                            <option value="">-</option>
                            @for($i = Carbon\Carbon::now()->year; $i <= Carbon\Carbon::now()->addYear(20)->year; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="card_owner">TITOLARE DELLA CARTA</label>
                        <input type="text" class="form-control" id="card_owner">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="code_cvv">CODICE CVV2</label>
                        <input type="text" class="form-control" id="code_cvv">
                    </div>
                </div>
                <a class="btn btn-primary" href="#">Concludi ordine</a>
            </fieldset>
        </div>
    </div>
@endsection

@section('js')
@endsection
