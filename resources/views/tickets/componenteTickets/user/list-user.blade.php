@extends('layouts/contentLayoutMaster')

@section('title', 'Soporte de ticket')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection

@section('content')
<div class="title mb-5">
    <p class="rosado">Soporte <br> Ticket</p>
</div>
<div class="card">
    <!--Card Header--->
    <div class="card-header">
        <h4 class="text-white fw-bold">
            Listado de Tickets
        </h4>
    </div>
    <!--Card Header End--->
    <div class="card-body">
        <table class="table w-100 nowrap scroll-horizontal-vertical myTable table-striped w-100">

            <thead>
                <tr class="text-center">
                    <th>id</th>
                    <th>Sujeto</th>
                    <th>Estado</th>
                    <th>Última Respuesta</th>
                    <th>Acción</th>
                </tr>
            </thead>
            @foreach ($ticket as $item)
            <tr class="text-center">
                <td># {{ $item->id}}</td>
                <td>[Ticket #{{ $item->user_id}}] {{$item->issue}}</td>

                @if ($item->status == '0')
                <td> <a class=" btn text-bold-600 text-white" style="background-color:rgba(5,255,0,0.7);border-radius: 8px;">Abierto</a></td>
                @elseif($item->status == '1')
                <td> <a class=" btn  text-bold-600 text-white" style="background-color:rgba(255,0,0,0.6);border-radius: 8px;">Cerrado</a></td>
                @endif

                @if ($item->send == '')
                <td>No hay mensaje Disponibles</td>
                @else
                <td>{{$item->send}}</td>
                @endif


                @if ($item->status == '0')
                <td><a href="{{ route('ticket.edit-user',$item->id) }}">
                        <button class=" btn text-bold-600 text-white" style="background: rgba(0, 246, 225, 0.77);border-radius: 8px;">Editar</button>
                    </a></td>
                @else
                <td><a href="{{ route('ticket.show-user',$item->id) }}">
                        <button class=" btn text-bold-600 text-white" style="background: rgba(246, 74, 0, 0.77);border-radius: 8px;">Ver</button>
                    </a></td>
                @endif

            </tr>
            @endforeach
            </tbody>
        </table>

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