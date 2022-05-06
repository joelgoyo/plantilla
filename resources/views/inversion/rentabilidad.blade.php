@extends('layouts/contentLayoutMaster')

@section('title', 'Rentabilidad')
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('content')
<!-- Basic Tables start -->
@if (session('status'))
<div class="alert alert-danger">
    {{ session('status') }}
</div>
@endif

<div class="row" id="basic-table">
    <div class="col-12">
        <div class="card">
            <div class="card-body card-dashboard">
                <!--Pagar rentabilidad boton-->
                <div class="float-end">
                    <button class="btn btn-danger" id="btnModalCartera">Pagar Rentabilidad</button>
                </div>
                <!--Pagar rentabilidad boton End-->
                <!--Pagar rentabilidad title-->
                <div class="card-title">
                    <h4>Rentabilidad</h4>
                </div>
                <!--Pagar rentabilidad title end-->
                <div class="table-responsive">
                <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
                        <thead class="">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Monto</th>
                                <th>% utilidad</th>
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
                                    {{$rentabilidad->gain}}
                                </td>
                                <td>
                                    {{$rentabilidad->percentage * 100 }}
                                </td>
                                <td>
                                    {{$rentabilidad->created_at}}
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

<!-- Modal Administrador de cartera-->

<!-- Vertical modal -->
<div class="vertical-modal-ex">
    <!-- Modal -->
    <div class="modal fade" id="ModalCartera" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Porcentaje de rentabilidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('porcentajeRentabilidad')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="porcentaje" class="form-label">Porcentaje</label>
                            <input type="number" class="form-control" id="porcentaje" aria-describedby="porcentaje" name="porcentaje" step="any">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
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
    let btnModalCartera = document.querySelector('#btnModalCartera');

    btnModalCartera.addEventListener("click", function(event) {

        let myModal = new bootstrap.Modal(document.getElementById('ModalCartera'), {
            keyboard: false
        })

        myModal.show();

    }, false);
    //datataables ordenes
    $('.myTable').DataTable({
        responsive: false,
        order: [
            [0, "desc"]
        ],
    })
</script>
@endsection