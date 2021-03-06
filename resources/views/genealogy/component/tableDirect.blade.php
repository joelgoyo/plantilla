<table class="table w-100 nowrap scroll-horizontal-vertical myTable">
    <thead class="">
        <tr class="text-center text-white bg-purple-alt2">
            <th>Nombre</th>
            <th>Correo</th>
            <th>Lado Matriz</th>
            <th>Nivel</th>
            <th>Invertido</th>
            <th>Estado</th>
            <th>Ingreso</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr class="text-center">
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->binary_side}}</td>
            <td>{{$item->nivel}}</td>
            <td>{{$item->montoInvertido()}} {{$item->status}}</td>
            
            @if ($item->status == '0')
            <td> <a class=" btn btn-outline-primary text-white text-bold-600">Inactivo</a></td>
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
        </tr>
        @endforeach
    </tbody>
</table>
