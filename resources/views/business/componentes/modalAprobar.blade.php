@extends('layouts/contentLayoutMaster')

@section('title', 'Confirmar Retiro')

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

@section('content')
<!-- Modal -->
<div class="{{-- modal fade --}} col-8 offset-md-2" id="modalModalAprobar" {{-- tabindex="-1" role="dialog" aria-labelledby="modalModalAprobarTitle"
    aria-hidden="true" --}}>
    <div class="{{-- modal-dialog modal-dialog-centered modal-dialog-centered" role="document" --}} card bg-lp>
        <div class=" {{-- modal-content --}}">
        <div class="{{-- modal-header --}} card-header">
            <h5 class="{{-- modal-title --}} card-title " id="modalModalAprobarTitle">Aprobar Retiro</h5>
            {{-- <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
        </div>
        <div class="{{-- modal-body --}} text-justify card-body card-dashboard">
            {{-- <div class="alert alert-primary" role="alert">
                    Intentos Fallidos {{session('intentos_fallidos')}}/3
        </div> --}}
        <form action="{{route('settlement.process')}}" method="post">
            @csrf
            <input type="hidden" name="action" value="aproved">

            <div class="form-group">
                <label for="">Codigo Correo</label>

                <input type="hidden" name="wallet" value={{$data['wallet']}}>
                <input type="hidden" name="idLiquidation" value={{$data['idLiquidation']}}>
                <input type="text " name="correo_code" class="form-control" required>
                <div class="col-12 text-center mt-1">

                </div>
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary">Aprobar</button>
            </div>
        </form>
    </div>

</div>
</div>
</div>
@endsection