@extends('layouts/contentLayoutMaster')

@section('title', 'Rentabilidad')

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
                    <h4>Rentabilidad</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Monto</th>
                                    <th>% utilidad</th>
                                    <th># Contrato</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rentabilidades as $rentabilidad)
                                <tr class="text-center">
                                    <td>
                                        {{$rentabilidad->id}}
                                    </td>
                                    <td>
                                        {{$rentabilidad->amount}}
                                    </td>
                                    <td>
                                        {{$rentabilidad->percentage * 100 }}
                                    </td>
                                    <td>
                                        {{$rentabilidad->inversion_id }}
                                    </td>
                                    <td>
                                        @if($rentabilidad->status == 0)
                                        En Espera
                                        @elseif($rentabilidad->status ==1)
                                        Pagada
                                        @else
                                        Reinvertido
                                        @endif
                                    </td>
                                    <td>
                                        {{$rentabilidad->created_at->format('d/m/Y')}}
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