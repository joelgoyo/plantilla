@extends('layouts/contentLayoutMaster')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection

@section('content')
<div class="card">
    <div class="card-header  mb-5">
        <h4>Crear Nueva educacion</h4>
        <button type="button" class="btn rosado Referral-btn" id="btnModalCategorie">Nueva Categoria</button>
    </div>
    <form method="POST" action="{{ route('education.store') }}" novalidate enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <!--ROW TITULO -->
                <div class="col-6">
                    <label for="title" class="h4"><strong>Titulo</strong> :</label>
                    <div class="input-group">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Agregar Titulo">
                        @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--ROW TITULO END-->
                </div>

                <div class="col-6">
                    <!--ROW Categoria-->
                    <label for="categorie_id" class="h4"><strong>Categoria</strong> :</label>
                    <div class="input-group">
                        <select id="categorie" class="rounded form-control" name="categorie">
                            @if(count($categorie) > 0 )
                            <option disabled selected>--seleccione una categoria--</option>
                            @foreach($categorie as $item)
                            <option {{old('categorie') == $item->id ? 'selected' : ''}} value="{{$item->id}}">
                                {{$item->name}}
                            </option>
                            @endforeach
                            @else
                            <option disabled selected class="text-white">--No hay categorias disponibles--</option>
                            @endif
                        </select>
                        @error('categorie_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--ROW Categoria END-->
                </div>
                <div class="card-footer mt-5">

                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-5 capa-exterior ">

                            <form id="frm-example" name="frm-example">
                                <label for="hiddenBtn" class="choose-btn capa-interior" id="chooseBtn"><i class="fas fa-upload rosado"></i> Subir Video</label>
                                <input type="file" id="hiddenBtn" accept="video/*" type="file" class="form-control @error('video') is-invalid @enderror" name="video" value="{{ old('video') }}">
                            </form>
                            <br>

                            @error('image')
                            <small class="text-danger">
                                {{$message}}
                            </small>
                            @enderror

                        </div>
                    </div>
                    <div class="boton mt-5 d-flex justify-content-center">
                        <button class="btn rosado Referral-btn" style="font-weight: bold;">Añadir nueva educacion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--MODAL CREAR CATEGORIA-->
<div class="modal fade" id="ModalCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-white" id="exampleModalCenterTitle">Crear Nueva Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('education.categorie')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <label for="name" class="text-white mt-1"><strong>Nombre:</strong></label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn rosado Referral-btn" data-dismiss="modal" arial-label="close" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn rosado Referral-btn">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    let btnModalCartera = document.querySelector('#btnModalCategorie');
    btnModalCartera.addEventListener("click", function(event) {
        let myModal = new bootstrap.Modal(document.getElementById('ModalCategorie'), {
            keyboard: false
        })
        myModal.show();
    }, false);
</script>
@endsection
