@extends('layouts/contentLayoutMaster')

@section('title', 'Lista de Kyc')

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
                        <h4 >lista de Kyc</h4>
                    </div>
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">
                                <thead class="">
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Usuario</th>
                                        <th>Foto frontal</th>
                                        <th>Foto Trasera</th>
                                        <th>Estado</th>
                                        <th>Accion</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    @foreach ($kyc as $item)
                                        <tr class="text-center">
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->user->name}} {{$item->user->lastname}}</td>
                                            <td>

                                                <a type="button" class="btn rosado Referral-btn" href="{{asset('/storage/photo-kyc/frontal/'.$item->photo_Forward)}}" download="{{asset('/storage/photo-kyc/frontal/'.$item->photo_Forward)}}">Descargar</a>
                                            </td>
                                            <td>
                                                <a type="button" class="btn rosado Referral-btn" target="_blank" href="{{asset('/storage/photo-kyc/trasera/'.$item->photo_rear)}}" download="{{asset('/storage/photo-kyc/trasera'.$item->photo_rear)}}">Descargar</a>
                                            </td>
                                            <td>
                                                @if($item->status == 0 )
                                                   En espera
                                                @elseif($item->status == 1)
                                                   Verificada
                                                @else
                                                    Cancelada
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button"
                                                    @if ($item->status == '0')
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#ModalStatus{{$item->id}}"
                                                    @endif

                                                    class="btn rosado Referral-btn">Verificar
                                              </button>
                                            </td>
                                        </tr>
                                        @if ($item->status == '0')
                                            <!-- Modal -->
                                            <div class="modal fade" id="ModalStatus{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cambiar estado</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('cambiarStatusKyc') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">

                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    ¿Desea cambiar es estado de la kyc?
                                                    <br>
                                                    <label>Seleccione el estado</label>
                                                    <select name="status" required class="form-control">
                                                        <option value="">Seleccione un estado</option>
                                                        <option value="1">verificado</option>
                                                        <option value="2">Cancelado</option>
                                                    </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
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
        order: [[ 0, "desc" ]],
    })
    </script>
@endsection
