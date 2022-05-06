@extends('layouts/contentLayoutMaster')

@section('title', 'Retirar Ganancias')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
<style>
    .bg-gris {
        background: #5f5f5f5f;
    }

    a.btn.btn-primary.d.waves-effect.waves-light {
        margin-top: 15px;
        padding: 12px;
        font-size: 22px;
    }

    h2.card-title.text-white {
        font-size: 24px !important;
        line-height: 34px;
        font-weight: 600;
    }

    p.text-white5 {
        font-size: 40px;
        padding: 5px;
    }

    .form-control {
        background: #141414 !important;
    }

    h5.text-white {
        font-size: 14px;
        line-height: 20px;
    }

    input#to::placeholder {
        font-size: 12px;
        background: #141414;
        border: 0px;
    }

    p.text-white1 {
        margin-left: 5px;
        font-size: 14px !important;
        font-weight: 600;
    }

    p.text-white1 span {
        font-weight: 400;
        font-size: 12px !important;
        padding-left: 5px;
    }
</style>
@endpush

{{-- @push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

@push('custom_js')
<script src="{{asset('assets/js/withdraw.js')}}"></script>
@endpush --}}


@section('content')
<div id="withdraw">
    <div class=" col-8 offset-md-2">
        <div class="card bg-lp">
            <div class="card-header">
                <h2 class="card-title  ">Retirar Ganancias</h2>
            </div>
            @if (!isset($liquidacion))
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <h5 class=" ">Moneda</h5>
                            <p class=" 1"> <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="" height="24"> USDT <span>TetherUS</span></p>
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class=" ">Dirección</h5>
                            <input type="text" id="to" placeholder="Introduce aquí la dirección" name="wallet" class="form-control bg-gris wallet">
                        </div>
                        <div class="col-12 col-md-12 mb-1">
                            <h5 class=" ">Red</h5>
                            <p class=" 1"> TRX <span>Tron (TRC20)</span></p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class=" ">Saldo en USDT</h5>
                            <p class=" 1"> {{Auth::user()->saldoDisponible()}}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class=" ">Retiro Minimo</h5>
                            <p class=" 1"> 50 USDT</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class=" ">% de Fee de Retiro</h5>
                            <p class=" 1"> 5%</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class=" ">Monto comision</h5>
                            <p class=" 1">{{ number_format(Auth::user()->getFeeWithdraw(), 2) }}</p>
                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <h5 class=" ">Importe que se recibirá</h5>
                            <p class=" 5">{{ number_format(Auth::user()->totalARetirar(),2) }} USDT</p>

                        </div>
                        <div class="col-6 col-md-6 mb-1">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInfo" onclick="mostrarWallet()">
                                Retirar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card-content">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-12 mb-1">
                    <h5 class=" ">Monedas</h5>
                    <p class=" 1"> <img src="https://icons.iconarchive.com/icons/cjdowner/cryptocurrency-flat/1024/Tether-USDT-icon.png" alt="" height="24"> USDT <span>TetherUS</span></p>
                </div>
                <div class="col-12 col-md-12 mb-1">
                    <h5 class=" ">Dirección</h5>
                    <input type="hidden" id="idd" value="{{$liquidacion->id}}">
                    <input type="text" id="to" placeholder="Introduce aquí la dirección" name="wallet" class="form-control bg-gris wallet" value={{$liquidacion->wallet_used}}>
                </div>
                <div class="col-12 col-md-12 mb-1">
                    <h5 class=" ">Red</h5>
                    <p class=" 1"> TRX <span>Tron (TRC20)</span></p>
                </div>
                <div class="col-6 col-md-6 mb-1">
                    <h5 class=" ">Saldo en USDT</h5>
                    <p class=" 1"> {{$liquidacion->monto_bruto}}</p>
                </div>
                <div class="col-6 col-md-6 mb-1">
                    <h5 class=" ">Retiro Minimo</h5>
                    <p class=" 1"> 50 USDT</p>
                </div>
                <div class="col-6 col-md-6 mb-1">
                    <h5 class=" ">% de Fee de Retiro</h5>
                    <p class=" 1"> 5%</p>
                </div>
                <div class="col-6 col-md-6 mb-1">
                    <h5 class=" ">Monto comision</h5>
                    <p class=" 1">{{ number_format($liquidacion->feed, 2) }}</p>
                </div>
                <div class="col-6 col-md-6 mb-1">
                    <h5 class=" ">Importe que se recibirá</h5>
                    <p class=" 5" id="total">{{ number_format($liquidacion->total,2) }} USDT</p>

                </div>
                <div class="col-6 col-md-6 mb-1">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInfo" onclick="mostrarWallet()">
                        Retirar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
{{-- @include('business.componentes.modalAprobar')
    @include('business.componentes.modalInfo') --}}

<!-- Modal -->
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="modalInfoTitle">Detalles Retiro</h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <form action="
                        @if(isset($liquidacion))
                            {{route('settlement.procesarRetiroCapital')}}
                        @else
                            {{route('settlement.aprobarRetiro')}} 
                        @endif
                        " method="post">
                    @csrf
                    <h5 class="">Billetera: <input type="text" class="form-group" id="modal-wallet" name="wallet" value=""></h5>
                    @if(isset($liquidacion))
                    <h5 class="">Total a Recibir:
                        <b id="totalModal">
                            {{ number_format($liquidacion->total,2) }}
                            @else
                            {{ number_format(Auth::user()->totalARetirar(),2) }}
                            @endif
                            USDT
                        </b>
                        <input type="hidden" name="liquidacion_id" id="modal-id" value="">
                    </h5>

                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function mostrarWallet() {
        var modal = document.getElementById('to').value;
        document.getElementById('modal-wallet').value = modal;

        var idd = document.getElementById('idd').value;
        document.getElementById('modal-id').value = idd;
    }
</script>
@endsection