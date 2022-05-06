@extends('layouts/contentLayoutMaster')

@section('title', 'Liquidaciones')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
{{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection

@section('content')
<!-- Statistics card section -->
<section class="row">
  <!-- Miscellaneous Charts -->
  <!--/ Line Chart -->


  @if (Auth::user()->admin == 0)
  <div class="col-12">
    <div class="card card-statistics">
      <div class="card-header">
        <h4 class="card-title">Liquidaciones</h4>
        <div class="d-flex align-items-center">
          <p class="card-text me-25 mb-0">{{date('m-Y')}}</p>
        </div>

      </div>

    </div>
  </div>
  @endif
  @if (Auth::user()->admin == 1)
  <div class="col-lg-12 col-12">
    @else
    <div class="col-lg-12 col-12">
      @endif
      <div id="logs-list">
        <div class="col-12">
          <div class="card">
            <div class="card-content">
              @if (session('status'))
              <div class="alert alert-danger">
                {{ session('status') }}
              </div>
              @endif
              <div class="card-body card-dashboard">
                <div class="table-responsive">

                  <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                    <thead class="">

                      <tr class="text-center">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>wallet</th>
                        <th>Monto Bruto</th>
                        <th>Feed</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($liquidaciones))
                      @foreach ($liquidaciones as $liquidacion)
                      <tr class="text-center">
                        <td id="liquidationId">{{$liquidacion->id}}</td>
                        <td>{{$liquidacion->getUserLiquidation->email}}</td>
                        <td>{{$liquidacion->wallet_used}}</td>
                        <td>{{$liquidacion->monto_bruto}}</td>
                        <td>$ {{number_format($liquidacion->feed,2);}}</td>
                        <td>{{$liquidacion->total}}</td>
                        <td>
                          <button type="button" @if (Auth::user()->admin == 1 && $liquidacion->status == '0')
                            data-bs-toggle="modal"
                            data-bs-target="#ModalStatus{{$liquidacion->id}}"
                            @endif

                            class="@if ($liquidacion->status == '0') btn btn-info text-white text-bold-600 @elseif($liquidacion->status >= '1') btn btn-success text-white text-bold-600 @endif">{{$liquidacion->status()}}
                          </button>
                          <div class="modal fade" id="ModalStatus{{$liquidacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                                  <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="{{ route('retiros.cambiarStatus') }}" method="POST">
                                  @csrf
                                  <div class="modal-body">

                                    <input type="hidden" name="id" value="{{$liquidacion->id}}">
                                    ¿Desea cambiar es estatus de la orden?
                                    <br>
                                    <label>Seleccione el estado</label>
                                    <select name="status" required class="form-control">
                                      <option value="">Seleccione un estado</option>
                                      <option value="0">Pendiente</option>
                                      <option value="1">Aprobado</option>

                                    </select>


                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          @if ($liquidacion->type == '0')
                          <span class="badge bg-secondary">Comisiones</span>
                          @elseif($liquidacion->type == '1')
                          <span class="badge bg-success">Capital</span>
                          @endif
                        </td>
                        <td>{{date('d-m-Y', strtotime($liquidacion->created_at));}}</td>
                        {{-- <td>{{$value->getWalletReferred->email}}</td> --}}


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

    {{-- @include('liquidaciones.components.cambiarStatus') --}}
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
{{-- <script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script> --}}
<script>
  //datataables ordenes
  $('.myTable').DataTable({
    responsive: false,
    order: [
      [0, "desc"]
    ],
  });
</script>
@endsection