@extends('mongicommerce.template.layout')
@section('title','Gift Card')
@section('description','La tua gift card')
@section('css')
@endsection
@section('content')
<div class="container mb-5">
    @foreach($gifts_info as $gift_info)
        <div id="gift_{{$loop->index}}" class="row mt-5 card" style="padding: 15px">
            <h3>INFORMAZIONI GIFT CARD</h3>
            <div class="row mt-3">
                <div class="col-md-6 ">
                    <div class="form-group">
                        <label for="name">Nome gift card</label>
                        <input id="name" type="text" class="form-control" value="{{$gift_info['name']}}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price">Valore</label>
                        <input id="price" type="text" class="form-control" value="€ {{$gift_info['price']}}" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="duration">Durata</label>
                        <input id="duration" type="text"  class="form-control" value="{{$gift_info['duration']}} giorni" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="bought_the">Acquistato il</label>
                        <input id="bought_the" type="text" class="form-control" value="{{$gift_info['bought_the']}}" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="expires_on">Scade il</label>
                        <input id="expires_on" type="text" class="form-control" value="{{$gift_info['expires_on']}}" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="code">Codice</label>
                        <input id="code" type="text" class="form-control" value="{{$gift_info['code']}}" disabled>
                    </div>
                </div>

            </div>
            <div class="row col-md-12 d-flex justify-content-end">
                <button class="btn btn-primary" type="button" onclick="printDiv({{$loop->index}})">Salva gift card</button>
            </div>
        </div>
    @endforeach
</div>
@endsection
@section('js')
    <script>
        let style = '{{asset('mongicommerce/template/shop/css/style.css')}}';
        let bootoast = '{{asset('mongicommerce/template/shop/plugins/jqueryToast/bootoast.css')}}';
        let bootstap = '{{asset('mongicommerce/template/shop/css/bootstrap.css')}}';
        function printDiv(index) {
            let divName = "gift_" + index;
            let divContents = document.getElementById(divName).innerHTML;
            let a = window.open('', '', 'height=1000, width=1400');
            a.document.write('<html>');
            a.document.write('<link rel="stylesheet" href="' + bootstap + '"/>');
            a.document.write('<link rel="stylesheet" href="' + style + '"/>');
            a.document.write('<link rel="stylesheet" href="' + bootoast + '"/>');
            a.document.write('<body >');
            a.document.write('<div class="container mb-5">');
            a.document.write(divContents);
            a.document.write('</body></div></html>');
            setTimeout(function(){a.print();},500);
            a.document.close();
        }
    </script>
@endsection
