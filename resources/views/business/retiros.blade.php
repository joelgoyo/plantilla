@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de Retiros')

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
                    <h4>Historial de retiro</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Monto</th>
                                    <th>Fee</th>
                                    <th>A recibir</th>
                                    <th>Referencia de Pago</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($retiros as $retiro)
                                <tr class="text-center">
                                    <td>
                                        {{$retiro->id}}
                                    </td>
                                    <td>
                                        {{$retiro->monto_bruto }}
                                    </td>
                                    <td>
                                        {{$retiro->feed}}
                                    </td>
                                    <td>
                                        {{$retiro->total}}
                                    </td>
                                    <td>
                                        {{$retiro->referencia }}
                                    </td>
                                    <td>
                                        @if($retiro->type == 0)
                                        Comision
                                        @elseif($retiro->status ==1)
                                        Capital
                                        @else
                                        Retirado
                                        @endif
                                    </td>
                                    <td>
                                        @if($retiro->status == 0)
                                        En Espera
                                        @elseif($retiro->status ==1)
                                        Pagado
                                        @else
                                        Retirado
                                        @endif
                                    </td>
                                    <td>
                                        {{$retiro->created_at->format('d/m/Y')}}
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