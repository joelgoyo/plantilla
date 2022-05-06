@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de inversiones')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h4>Inversiones</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Contrato</th>
                                    <th>Monto Invertido</th>
                                    <th>Tipo de Interes</th>
                                    <th>Ganancia</th>
                                    <th>Capital</th>
                                    <th>Estado</th>
                                    <th>Fecha de Activación</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($inversiones as $value)
                                <tr>
                                    <td>
                                        {{$value->id}}
                                    </td>
                                    <td>{{$value->user->name}} {{$value->user->lastname}}</td>
                                    <td>
                                        @if($value->orden_purchases_id == 'compra')
                                        Compra
                                        @elseif($value->orden_purchases_id == 'reactivacion')
                                        Reactivacion
                                        @else
                                        Compra
                                        @endif
                                    </td>
                                    <td>
                                        $ {{number_format($value->invested,2)}}
                                    </td>
                                    <td>
                                        Compuesto
                                    </td>
                                    <td>
                                        $ {{number_format($value->ganancia_rendimiento(),2)}}
                                    </td>
                                    <td>
                                        $ {{number_format($value->capital,2)}}
                                    </td>
                                    <td>
                                        {!!$value->estado()!!}
                                    </td>
                                    <td>
                                        {{$value->created_at->format('d-m-Y')}}
                                    </td>
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

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>

@endsection
@section('page-script')
<script>
    //datataables ordenes
    $('.myTable').DataTable({
        responsive: false,
        order: [
            [0, "desc"]
        ],
    })
</script>
@endsection