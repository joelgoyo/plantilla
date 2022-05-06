@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de ordenes')

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
                    <h4>Ordenes</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">

                                <tr class="text-center">
                                    <th>ID</th>
                                    @if (Auth::user()->admin == 1)
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    @endif
                                    <th>Transaccion</th>
                                    <th>Monto</th>
                                    <th>Estado</th>
                                    <th>Fecha de Creación</th>
                                </tr>

                            </thead>
                            <tbody>

                                @foreach ($ordenes as $orden)
                                <tr class="text-center">
                                    <td>{{$orden->id}}</td>
                                    @if (Auth::user()->admin == 1)
                                    <td>{{$orden->user->name}}</td>
                                    <td>{{$orden->user->email}}</td>
                                    @endif
                                    <td>
                                        @if(isset($orden->cointpayment))
                                        <a href="{{$orden->cointpayment ?  $orden->coinpayment_alternativa_link() : ''}}" target="_blank">{{$orden->cointpayment->txn_id}}</a>
                                        @endif
                                    </td>
                                    <td>{{$orden->amount}}</td>
                                    <td>
                                        <button type="button" @if (Auth::user()->admin == 1 && $orden->status == '0')
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalStatus{{$orden->id}}"
                                            @endif

                                            class="@if ($orden->status == '0') btn btn-info text-white text-bold-600 @elseif($orden->status == '1') btn btn-success text-white text-bold-600 @elseif($orden->status >= '2') btn btn-danger text-white text-bold-600 @endif">{{$orden->status()}}
                                        </button>
                                    </td>
                                    <td>{{$orden->created_at->format('Y-m-d')}}</td>
                                </tr>
                                @if (Auth::user()->admin == 1 && $orden->status == '0')
                                <!-- Modal -->
                                <div class="modal fade" id="ModalStatus{{$orden->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('cambiarStatus') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">

                                                    <input type="hidden" name="id" value="{{$orden->id}}">
                                                    ¿Desea cambiar es estatus de la orden?
                                                    <br>
                                                    <label>Seleccione el estado</label>
                                                    <select name="status" required class="form-control">
                                                        <option value="">Seleccione un estado</option>
                                                        <option value="1">Aprobado</option>
                                                        <option value="2">Rechazado</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
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