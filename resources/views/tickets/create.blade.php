@extends('layouts/contentLayoutMaster')

@section('title', 'Creación de ticket')

@section('content')

<div class="title mb-5">
    <p class="rosado">Soporte <br> Ticket</p>
</div>

<section id="basic-vertical-layouts">
    <div class="match-height d-flex justify-content-center">
        <div class="col-md-12 col-12">
            <div class="card">
                <!--Card Header--->
                <div class="card-header">
                    <h4 class="text-white fw-bold">
                        Crear
                    </h4>
                </div>
                <!--Card Header End--->

                <div class="card-body">
                    <form action="{{route('ticket.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <!--SELECT-->
                                <span class=" text-bold-600">Categorias:</span>

                                <select class="form-select" name="categories">
                                    <option value="0">Ayuda</option>
                                    <option value="1">Soporte técnico</option>
                                    <option value="2">Corrección de datos</option>
                                    <option value="3">Bonos</option>
                                    <option value="4">Inversión total</option>
                                </select>
                                <!--SELECT END-->
                            </div>

                            <div class="col-sm-4">
                                <!--INPUT DE PRIORIDADES-->
                                <span class=" text-bold-600">Prioridades:</span>
                                <select class="form-select" name="priority">
                                    <option value="0">Alta</option>
                                    <option value="1">Media</option>
                                    <option value="2">Baja</option>
                                </select>
                                <!--INPUT DE PRIORIDADES END-->
                            </div>

                            <div class="col-sm-8 mb-2 mt-2">
                                <!--Asunto -->
                                <span class=" text-bold-600">Asunto:</span>
                                <div class="input-group input-group-lg">
                                    <input type="text" name="issue" class="form-control">
                                </div>
                                <!--Asunto end-->
                            </div>

                            <div class="col-sm-8">
                                <!--MENSAJE-->
                                <span class=" text-bold-600">Mensaje:</span>
                                <textarea class="form-control" type="text" id="message" name="message" required rows="3" style="background-color:#1d1b2f;height: 190px;border: 1px #404656 solid;"></textarea>
                                <!--MENSAJE END-->
                            </div>

                            <div class="col-sm-4 mt-2">

                                <!--CONTENEDOR DE ARCHIVO ADJUNTO-->
                                <div class="container-fluid capa-exterior">

                                    <form id="frm-example" name="frm-example">
                                        <label for="hiddenBtn" class="choose-btn capa-interior" id="chooseBtn"><i class="fas fa-upload rosado"></i> Ajuntar archivo</label>
                                        <input type="file" id="hiddenBtn" name="image">
                                    </form>
                                    <br>
                                </div>
                                @error('image')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
                                <br>
                                <!--CONTENEDOR DE ENVIAR Y PAPELERA-->
                                <div class="row mt-1">

                                    <div class="col-sm-12">
                                        <div class="row justify-content-between">
                                            <div class="col-4">
                                                <!--BOTON ENVIAR-->
                                                <button class="btn btn-success">Enviar</button>
                                            </div>
                    </form>

                    <div class="col-4">
                        <!--BOTON ELIMINAR-->

                        <span class="rosado" style="font-size: 20px;">
                            | <i id="remove" class=" far fa-trash-alt"></i>
                        </span>
                        <!--BOTON ELIMINAR END-->
                    </div>

                    <!--CONTENEDOR DE ENVIAR Y PAPELERA END-->
                </div>
                <!--CONTENEDOR DE ARCHIVO ADJUNTO END-->
            </div>
        </div>
    </div>
    </div>
</section>
@endsection