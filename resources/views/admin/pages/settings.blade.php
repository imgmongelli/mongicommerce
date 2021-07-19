@extends('mongicommerce::admin.template.layout')
@section('title','Impostazioni')
@section('title_icon',"fa-cogs")
@section('subtitle','')
@section('description','Imposta i settaggi base per il tuo e-commerce')
@section('css')
@endsection
@section('subheader')
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>
                        Impostazioni <span class="fw-300"><i>Compila i campi</i></span>
                    </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="panel-tag">
                            Input masks can be used to force the user to enter data conform a specific format. Unlike validation, the user can't enter any other key than the ones specified by the mask
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="p-20">
                                    <form action="#">
                                        <div class="form-group">
                                            <label class="form-label">Nome negozio</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-scanner-touchscreen width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="nome_negozio" placeholder="" value="{{$settings->shop_name}}" class="form-control">
                                            </div>
                                            <span class="help-block">e.g. "ShopName"</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">IBAN</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-desktop width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="iban" placeholder="" value="{{$settings->iban}}" class="form-control">
                                            </div>
                                            <span class="help-block">http:// or ftp://</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-mouse-pointer width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="email" id="email" placeholder="" value="{{$settings->email}}" class="form-control">
                                            </div>
                                            <span class="help-block">xx@xxx.xx</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Prezzo minimo di acquisto</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="number" id="acquisto_min" placeholder="" value="{{$settings->minimum_shop}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 10</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Stripe KEY</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-credit-card width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="api_key" placeholder="" value="{{$settings->stripe_api_key}}" class="form-control">
                                            </div>
                                            <span class="help-block">4deg:1340:6547:2:540:h8je:ve73:98pd</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Stripe SECRET</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-window-alt width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="api_secret" placeholder=""  value="{{$settings->stripe_api_secret}}" class="form-control">
                                            </div>
                                            <span class="help-block">4deg:1340:6547:2:540:h8je:ve73:98pd</span>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Soglia spedizione gratuita</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="soglia_spedizione" placeholder=""  value="{{$settings->free_delivery}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Costo spedizione minimo</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="min_spedizione" placeholder=""  value="{{$settings->min_delivery}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Costo spedizione meno di 5kg</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="meno_5kg" placeholder=""  value="{{$settings->delivery_less_5}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Costo spedizione tra i 5 e 10 kg</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="meno_10kg" placeholder=""  value="{{$settings->delivery_less_10}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-20">
                                    <form action="#">
                                        <div class="form-group">
                                            <label class="form-label">Capitale sociale</label>
                                            <input type="number" id="capitale_sociale" placeholder=""  value="{{$settings->share_capital}}" class="form-control">
                                            <span class="help-block">99-9999999</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Indirizzo</label>
                                            <textarea id="indirizzo" class="form-control">{{$settings->address}}</textarea>
                                            <span class="help-block">Indirizzo, città, numero, provincia, Nazione</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Partita Iva</label>
                                            <input type="number" id="piva" placeholder="" value="{{$settings->piva}}" class="form-control">
                                            <span class="help-block">(999) 999-9999</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Currency</label>
                                            <input type="text" id="currency" placeholder="" value="{{$settings->currency}}" class="form-control">
                                            <span class="help-block">$, € ...</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Telefono</label>
                                            <input type="text" id="telefono" placeholder="" value="{{$settings->telephone}}" class="form-control">
                                            <span class="help-block">333999999</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Email reclami</label>
                                            <input type="email" id="email_reclami" placeholder="" value="{{$settings->claim_email}}" class="form-control">
                                            <span class="help-block">xx@xxx.xx</span>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Elaborazione costi di spedizione:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shipping_price" id="prezzo_fisso" @if(!$settings->is_by_weight) checked @endif>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Prezzo fisso
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="shipping_price" id="prezzo_peso" @if($settings->is_by_weight) checked @endif>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Per peso
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">Costo spedizione tra i 10 e i 20 kg</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="meno_20kg" placeholder=""  value="{{$settings->delivery_less_20}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Costo spedizione tra i 20 e i 30 kg</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="meno_30kg" placeholder=""  value="{{$settings->delivery_less_30}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Costo spedizione tra i 30 e i 50 kg</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-euro-sign width-1 text-align-center"></i></span>
                                                </div>
                                                <input type="text" id="meno_50kg" placeholder=""  value="{{$settings->delivery_less_50}}" class="form-control">
                                            </div>
                                            <span class="help-block">€ 999</span>
                                        </div>
                                    </form>

                                </div>

                            </div>
                            <!-- end col -->
                        </div>

                    </div>

                </div>

            </div>
            <button id="save_settings" class="btn btn-primary btn-block">Salva</button>
        </div>
    </div>
@endsection
@section('js')
<script>
    $('#save_settings').click(function (){
        $.ajax({
            method:'post',
            url:"{{route('admin.post.settings.update')}}",
            data:{
                nome_negozio : $('#nome_negozio').val(),
                iban : $('#iban').val(),
                email : $('#email').val(),
                acquisto_min : $('#acquisto_min').val(),
                api_key : $('#api_key').val(),
                api_secret : $('#api_secret').val(),
                capitale_sociale : $('#capitale_sociale').val(),
                indirizzo : $('#indirizzo').val(),
                piva : $('#piva').val(),
                currency : $('#currency').val(),
                telefono : $('#telefono').val(),
                email_reclami : $('#email_reclami').val(),
                free_delivery : $('#soglia_spedizione').val(),
                min_delivery : $('#min_spedizione').val(),
                is_by_weight : document.getElementById('prezzo_peso').checked,
                less_5 : $('#meno_5kg').val(),
                less_10 : $('#meno_10kg').val(),
                less_20 : $('#meno_20kg').val(),
                less_30 : $('#meno_30kg').val(),
                less_50 : $('#meno_50kg').val()
            },
            success:function (response){
                success("Impostazioni modificate correttamente",true);
            }
        })
    })
</script>
@endsection
