@extends('layouts/contentLayoutMaster')

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


@section('title', 'Comisiones')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
{{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection

@section('content')

<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
  <div class=" flex-grow-1 bd-highlight">Wallet<br>Retiro*</div>
  <div class=" bd-highlight ">
    <h2 class="text-white fw-bold">

  </div>
  <div class="avatar bg-light-success p-1 me-auto">
    <div class="avatar-content">
      <i class="fas fa-dollar-sign" style="font-size:25px;" class="avatar-icon"></i>
    </div>
  </div>

  <div class="my-auto ">
    <h2 class="fw-bolder mb-0 text-white">$
      @if(isset($saldoDisponible))
      {{$saldoDisponible}}
      @else
      0
      @endif
    </h2>
    <p class="card-text text-white font-small-3 mb-0">Saldo Actual</p>
  </div>
</div>
</div>

<!-- Statistics card section -->
<section class="row">
  <!-- Miscellaneous Charts -->
  <!--/ Line Chart -->
  <div class="title mb-5 ">
    <p class="rosado">Datos de transferencia</p>
    <div class="row">
      <div class="col-lg-12 col-12 order-2 order-lg-1">
        <div class="card">
          <form action="{{route('settlement.process')}}" method="post">
            @csrf
            <input type="hidden" name="action" value="aproved">
            <div class="card-body">
              <h4 class="text-white mb-2">Editar</h4>
              <div class="row">
                <!--ROW 1 START-->
                <div class="col-sm-4">
                  <label for="">Monto a Retirar:</label>
                  <div class="input-group mb-3">
                    <input type="text" readonly value="{{$saldoDisponible}}" id="monto" name="monto" class="form-control" placeholder="U$0000000" required>
                  </div>
                </div>

                <div class="col-sm-4">
                  <label for="">Fee de retiro 5%</label>
                  <br>
                  <div class="input-group mb-3">
                    <input type="text" readonly required id="fee" name="fee" class="form-control" placeholder="U$0000000" value="{{$fee}}">
                  </div>

                </div>

                <div class="col-sm-4">
                  <label for="">Pagar a:</label>
                  <div class="input-group mb-3">
                    <input type="text" name="wallet" class="form-control" placeholder="Wallet USDT">
                  </div>
                </div>
              </div>
              <!--ROW 1 END-->

              <div class="row">
                <!--ROW 2 START-->


                <div class="col-sm-4">
                  <label for="">Enviar código de verificación</label>
                  <div class="input-group mb-3">

                    <input type="hidden" name="idLiquidation" id="idLiquidation">
                    <input type="text" name="correo_code" class="form-control" placeholder="Ingresar codigo enviado al correo">
                    <span style="cursor: pointer;" onclick="sendCodeEmail()" class="input-group-text text-white fw-bold" id="span"></span>
                  </div>

                </div>
                <div class="col-sm-4">
                  <label for="">Pin de Seguridad:</label>
                  <br>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="xxxxxx" name="code_security">
                  </div>
                </div>
              </div>
              <!--ROW 2 END-->
              <div class="botones mt-2">
                <button type="submit" class="btn btn-success btn-lg">Solicitar</button>
          </form>
          <button type="button" id="restaurar" class="btn btn-danger btn-lg">Cancelar</button>
        </div>
      </div>
    </div>
    <div class="title">
      * Las solicitudes de retiro se deben efectuar desde el 1 al 5 de cada mes. * Monto mínimo a retirar U$60
      <br>
      * Monto minimo a retirar U$60

    </div>
  </div>
  </div>
  </div>
 
  @if (Auth::user()->admin == 1)
  <div class="col-lg-12 col-12">
    @else
    <div class="col-lg-12 col-12">
      @endif
      <div id="logs-list">
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              <div class="card-header">
                <h4>Wallet</h4>
              </div>
              <div class="card-body card-dashboard">
                <div class="table-responsive">
                  <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                    <thead class="">

                      <tr class="text-center">
                        <th>Monto</th>
                        <th>Email de referido</th>
                        <th>Id de referido</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($wallet))
                      @foreach ($wallet as $key => $value)
                      <tr class="text-center">
                        @if (Auth::user()->admin == 1)

                        <td>{{$value->id}}</td>
                        <td>{{$value->usuarios->name}}</td>
                        <td>{{$value->user_id}}</td>
                        <td>
                          @if ($value->tipo_transaction == 1)
                          <span class="badge bg-success">Retiro</span>
                          @else
                          <span class="badge bg-secondary">Comisión</span>
                          @endif
                        </td>
                        @endif
                        <td>$ {{number_format($value->amount,2);}}</td>
                        <td>
                          @if(isset($value->referred_id))
                          {{$value->getWalletReferred->email}}
                          @else

                          @endif
                        </td>
                        <td>
                          @if(isset($value->referred_id))
                          {{$value->getWalletReferred->id}}
                          @else

                          @endif
                        </td>
                        <td>{{$value->descripcion}}</td>
                        <td>
                          @if ($value->status == '0')
                          <span class="badge bg-warning">En Espera</span>
                          @elseif($value->status == '1')
                          <span class="badge bg-success">Completado</span>
                          @elseif($value->status >= '2')
                          <span class="badge bg-danger">Cancelado</span>
                          @endif
                        </td>
                        <td>{{date('d-m-Y', strtotime($value->created_at));}}</td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Line Chart Card -->
</section>
<!--/ Statistics Card section-->

@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection
@section('page-script')
<script>

</script>
{{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
<script>
  //datataables ordenes
  $('.myTable').DataTable({
    responsive: true,
    order: [
      [0, 'desc']
    ],
  })
</script>

<script>
  let span = document.getElementById('span');
  let enviar = 'Enviar';
  let enviado = 'Enviado';
  span.innerHTML = enviar;

  function sendCodeEmail() {
    let url = 'aprobarRetiro'
    fetch(url)
      .then((response) => {
        return response.json();
      })
      .then((response) => {
        if (IsNumeric(response) == true) {
          $('#idLiquidation').val(response)
          span.innerHTML = enviado;
          toastr.success("Codigo Enviado, Revise su correo", '¡Genial!', {
            "progressBar": true
          });
        } else {
          toastr.error("El monto minimo de retiro es 60 usdt", '¡Error!', {
            "progressBar": true
          });
        }
      }).catch(function(error) {
        console.log(error);
        toastr.error("Ocurrio un problema con la solicitud", '¡Error!', {
          "progressBar": true
        });
      })

  }

  function IsNumeric(val) {
    return Number(parseFloat(val)) === val;
  }

  //REESTAURA VALOR DE CAMPOS 
  $("#restaurar").click(function() {
    setTimeout(function() {
      window.location = '{{route("wallet.index")}}';
    });
  });

</script>

@endsection