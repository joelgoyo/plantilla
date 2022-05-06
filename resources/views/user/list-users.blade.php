@extends('layouts/contentLayoutMaster')

@section('title', 'Usuarios')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('content')
<div class="col-12">
    <div class="card ">
        <div class="card-content">
            <div class="card-header">
                <h4>Lista de usuarios</h4>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                        <thead>
                            <tr class="text-center ">
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Ingreso</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr class="text-center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                @if ($item->status == '0')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Inactivo</a></td>
                                @elseif($item->status == '1')
                                <td> <a class=" btn btn-success text-white text-bold-600">Activo</a></td>
                                @elseif($item->status == '2')
                                <td> <a class=" btn btn-warning text-white text-bold-600">Suspendido</a></td>
                                @elseif($item->status == '3')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Bloqueado</a></td>
                                @elseif($item->status == '4')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Caducado</a></td>
                                @elseif($item->status == '5')
                                <td> <a class=" btn btn-danger text-white text-bold-600">Eliminado</a></td>
                                @endif
                                <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                                <td>
                                    <form action="{{route('user.start', $item)}}" method="POST" class="btn">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary text-bold-600">
                                            <i data-feather='eye'></i>
                                        </button>

                                    </form>
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