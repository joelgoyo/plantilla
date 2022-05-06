@extends('layouts/contentLayoutMaster')

@section('title', 'Comision')

@section('vendor-style')
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')
    <div id="logs-list">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        <h4>Comisiones</h4>
                    </div>
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                                <table class="table nowrap scroll-horizontal-vertical comision_table table-striped">
                                <thead class="">

                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Referido</th>
                                        <th>Descripcion</th>
                                        <th>Monto</th>
                                        <th>Estado</th>
                                        <th>Fecha de Creación</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    @foreach ($wallets as $wallet)
                                    <tr class="text-center">
                                        <td>{{$wallet->id}}</td>
                                        <td>{{$wallet->name}}</td>
                                        <td>{{$wallet->referido}}</td>
                                        <td>{{$wallet->descripcion}}</td>
                                        <td>$ {{$wallet->amount}}</td>

                                        @if ($wallet->status == '0')
                                        <td> <a class=" btn btn-info text-white text-bold-600">Pendiente</a></td>
                                        @elseif($wallet->status == '1')
                                        <td> <a class=" btn btn-success text-white text-bold-600">Pagada</a></td>
                                        @elseif($wallet->status == '2')
                                        <td> <a class=" btn btn-danger text-white text-bold-600">Cancelada</a></td>
                                        @elseif($wallet->status == '3')
                                        <td> <a class=" btn btn-danger text-white text-bold-600">Reservada</a></td>
                                        @endif

                                        <td>{{date('Y-m-d', strtotime($wallet->created_at))}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- CONFIGURACIÓN DE DATATABLE --}}
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
    $('.comision_table').DataTable({
        responsive: true,
        order: [[ 0, "desc" ]],
    })
    </script>

@endsection
