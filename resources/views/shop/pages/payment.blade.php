@extends('mongicommerce.template.layout')
@section('title','pagamento')
@section('description',"Concludi l'ordine")
@section('css')
<style>
    .hide {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 mt-5 mb-5">
            <header class="centred mb-3">
                <h1>Scegli la modalità che ti è più comoda</h1>
            </header>
            @if (Session::has('error'))
            <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('error') }}</p>
            </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
            </div>
            @endif
            <div class="check-option mb-2">
                <input id="carta" name="div" type="radio"> <strong>Carta di credito</strong>
                <div style="display: none;" id="carta_block">
                    <fieldset>
                        <legend>INSERISCI I DATI DELLA TUA CARTA</legend>
                        <form role="form" action="{{route('shop.pay')}}" method="post" class="validation"
                            data-cc-on-file="false" data-stripe-publishable-key="{{ $api_stripe_key }}" id="payment-form">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="card-num">NUMERO DI CARTA</label>
                                    <input type="text" class="card-num form-control" id="card-num">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="card-expiry-month">MESE SCADENZA</label>
                                    <select class="card-expiry-month form-control" name="" id="card-expiry-month">
                                        <option value="">-</option>
                                        @for($i = 1; $i <= 12; $i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="card-expiry-year">ANNO SCADENZA</label>
                                    <select class="card-expiry-year form-control" name="card-expiry-year"
                                        id="card-expiry-year">
                                        <option value="">-</option>
                                        @for($i = Carbon\Carbon::now()->year; $i <= Carbon\Carbon::now()->addYear(20)->year;
                                            $i++)
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
                                    <label for="card-cvc">CODICE CVV2</label>
                                    <input type="text" class="card-cvc form-control" id="card-cvc">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class='form-row row'>
                                    <div class='col-md-12 hide error form-group'>
                                        <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                    </div>
                                </div>
                                <button class="btn btn-danger btn-lg btn-block" type="submit">Paga ora
                                    @money($total)
                                </button>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
            <div class="check-option mb-2">
                <input id="iban" name="div" type="radio"> <strong>Bonifico bancario</strong>
                <div style="display:none;" id="iban_block">
                    <blockquote>
                        {{$iban}}<br>
                        Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum.
                        Mirum est notare quam littera gothica, quam nunc putamus parum claram.
                    </blockquote>
                    <div class="row">
                        <div class="col-sm-12 btn-wrap">
                            <button onclick="pay('iban')" class="btn btn-default">Concludi Ordine</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="check-option mb-2">
                <input id="negozio" name="div" type="radio"> <strong>Pagamento in negozio</strong>
                <div style="display:none;" id="negozio_block">
                    <blockquote>
                        Al proseguimento l'ordine verrà creato e concluso al pagamento in negozio.
                    </blockquote>
                    <div class="row">
                        <div class="col-sm-12 btn-wrap">
                            <button onclick="pay('negozio')" class="btn btn-default">Concludi Ordine</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function () {
            var $form = $(".validation");
            $('form.validation').bind('submit', function (e) {
                var $form = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeHandleResponse);
                }

            });

            function stripeHandleResponse(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });

        $('input:radio').change(function () {
            let blocks = ['carta', 'iban', 'negozio'];
            $.each(blocks, function (index, value) {
                if ($('#' + value).is(':checked')) {
                    $('#' + value + '_block').show();
                } else {
                    $('#' + value + '_block').hide();
                }

            });
        });

        function pay(type) {
            let url_pay = '{{route('shop.normalpayment')}}';
            $.ajax({
                method: 'POST',
                url: url_pay,
                data: {
                    type_payment : type
                },
                'statusCode': {
                    422: function (response) {
                    }
                },
                success: function (response) {
                    window.location.href = response.url;
                }
            });
        }


</script>
@endsection
