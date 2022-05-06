@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<style>
    .list-group-item-action {
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div id="adminServices">

    <div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
        <div class="flex-grow-1 bd-highlight">Membresias Excelsior<br>Activación</div>
    </div>

    <div class="card">
        <div class="alert alert-info m-1" style="padding:8px;max-width:50rem;">
            <i class="fa fa-exclamation-circle"></i> Si usted ya posee una membresía no se le sera cobrada la fee
            en la siguiente.
        </div>
        <div class="card-header d-block">
            <div class="row colum">
                @if (isset($data))

                <div class="col-sm-2">
                    <h4 class="{{$data['clase']}}" style="font-size: 21px;">{{$data['name']}}</h4>
                </div>
                <div class="col-sm-5">
                    <h4 style="font-size: 20px;">{{$data['monto']}}</h4>
                </div>
                <div class="col-sm-4">

                    <p><i class="fas fa-desktop {{$data['clase']}}"></i> Rendimiento mensual hasta el</p>
                    <p><i class="fas fa-check {{$data['clase']}}"></i> Activación mensual</p>
                </div>
                <div class="col-sm-1">
                    <p>6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i></p>
                    <p>{{$data['activacion_manual']}}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="card-body card-dashboard">

            <div class="row">

                <input type="hidden" name="clase" @if (isset($data)) value={{$data['clase']}} @endif>
                <input type="hidden" name="name" @if (isset($data)) value={{$data['name']}} @endif>
                <input type="hidden" name="data_monto" @if (isset($data)) value={{$data['monto']}} @endif>
                <input type="hidden" name="activacion_manual" @if (isset($data)) value={{$data['activacion_manual']}} @endif>

                <div class="col-sm-4 mb-2">
                    <label for="montoo" class="form-label text-white">Monto a operar:</label>
                    <input type="text" class="form-control" name="montoo" id="montoo" autocomplete="off " placeholder="U$000000000" value="@if(isset($data['montoo'])){{$data['montoo']}}@endif" >
                </div>
                <div class="col-sm-4">
                    <label for="fee" class="form-label text-white">Fee:</label>
                    <input type="text" disabled class="form-control" name="fee" id="fee" value=" {{$fee}}" style="color: #a3a3af;">
                </div>

                <div class="col-sm-4">
                    <label for="total" class="form-label text-white">Total:</label>
                    <input type="text" name="total" id="total" class="form-control" placeholder="U$00000000" disabled value="@if (isset($data['total'])){{$data['total']}}@endif" style="color: #a3a3af;">

                </div>

            </div>

            <div class="col-12 mt-5 mb-2 position-relative" style="justify-content: end; display:flex;">
                <form action="{{route('shop.proccess')}}" method="POST">
                    @csrf
                    <input type="hidden" name="monto" id="monto" value="@if (isset($data['total'])){{$data['total']}}@endif">
                    <input type="hidden" name="minimo" id="minimo" value="@if (isset($data['minimo'])){{$data['minimo']}}@endif">
                    <input type="hidden" name="maximo" id="maximo" value="@if (isset($data['maximo'])){{$data['maximo']}}@endif">
                    <button type="submit" class="btn rosado Referral-btn activar"> Activar </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @media only screen and (max-width: 863px) {
        .card-header {
            display: flex;
            width: 100%;
        }
       
    }

    @media only screen and (max-width: 500px) {

        
        .colum {
            display: inline;
            width: 100%;
            flex-direction: column;
            margin: auto;
        }
     
    }
</style>

@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')

<script>
    document.getElementById("montoo").onchange = function() {
        updateValuesMonto()
    };

    let numero = document.getElementById('fee').value;


    function updateValuesMonto() {
        document.getElementById("total").removeAttribute("readonly");
        let montoo = document.getElementById("montoo");
        let monto = parseFloat(montoo.value);
        let total = parseFloat(montoo.value) + parseFloat(numero);
        document.getElementById("total").value = total;
        document.getElementById("monto").value = monto;
        document.getElementById("total").setAttribute("readonly", "readonly");
    }

    document.getElementById("email_code").onchange = function() {
        updateValuesCode()
    };

    function updateValuesCode() {

        let code = document.getElementById("email_code");
        document.getElementById("input_code").value = code.value;

        console.log(code.value);

    }
</script>

@endsection