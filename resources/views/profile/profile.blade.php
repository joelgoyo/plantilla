@extends('layouts/contentLayoutMaster')

@section('vendor-script')
<!-- vendor files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
<style type="text/css">
    select.custom-select{
    background-color: #1d1b2f;
    border-color: #404656;
    color: #fff;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding-left: 10px;
    }
</style>
@section('content')
<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
  <div class="p-2 flex-grow-1 bd-highlight">MI PERFIL<br>Información Personal</div>
  <div class="bd-highlight btn Referral-text">Referral Link: <span>{{route('register')}}?referred_id={{Auth::id()}}</span></div>
  <div class="p-2 bd-highlight"><button class="btn rosado Referral-btn" onclick="getlink()">Copiar</button></div>
</div>

<div id="user-profile">
   <!--Información Personal start-->
   <section id="profile-info">
        <div class="title mb-5">
            <p class="rosado">Información Personal</p>
            <div class="row">
                <div class="col-lg-12 col-12 order-2 order-lg-1">
                    <div class="card">
                        <div class="card-header mb-3">
                            <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                                <div class="col">
                                    <div class="p-1 ">
                                        @if (Auth::user()->photo == null)
                                            <a id="btnModalphoto"><img src="{{asset('images/portrait/small/avatar-s-8.jpg')}}" alt="Avatar" height="120" width="120" class="rounded-circle" /></a>
                                        @else
                                            <a id="btnModalphoto"><img class="rounded-circle"  src="{{ asset('storage/photo-profile/'.$user->photo) }}" alt="Avatar" width="120px" height="120px" data-toggle="modal" data-target="#fotos"></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col p-1">
                                    <div class="h4 m- text-white fw-bold">{{$user->name}} {{$user->lastname}}</div>
                                    @if($user->countrie_id != null)
                                        <span class="fw-bold mb-1">
                                        {{$user->countrie->name}}</span>
                                    @else
                                    @endif
                                        
                                        @if($user->kyc != null)
                                            @if($user->kyc->status == 1)
                                                <span class="d-flex justify-content-start mt-1">VERIFICADO <i class="fas fa-check " style="font-size:15px;color:#EBAAFF;"></i></span>
                                            @else
                                                <span class="d-flex justify-content-start ">SIN VERIFICAR <i data-feather='x-circle' style="font-size:15px;color:#ee4f05;"></i> </span>
                                            @endif
                                        @else
                                            <span class="d-flex justify-content-start ">SIN VERIFICAR</span>
                                        @endif
                                    
                                    <span class="fw-bold mt-1 d-flex justify-content-start">Usuarios</span>
                                    <span class="fw-bold d-flex justify-content-start h4 text-white">{{$user->id}}</span>
                                </div>
                                <div class="col p-2">
                                    @if($user->invertido != null )
                                        <div class="mb-1 MasterInvestor rosado text-center">{{(Auth::user()->paquete())}}</div>
                                    @else
                                        <div class="mb-1 MasterInvestor rosado text-center">Sin paquete Activo</div>
                                    @endif
                                    @if( $user->Invertido != null)
                                        @if($user->Invertido->status == 1)      
                                            <h4 class="text-white fw-bold">U$ {{$user->invertido->invested}}</h4>   
                                        @else
                                            <h4 class="text-white fw-bold">U$ 0</h4>
                                        @endif
                                    @else
                                        <h4 class="text-white fw-bold">U$ 0</h4>
                                    @endif
                                </div>   
                           </div>
                        </div>
                        <div class="card-body">
                        <h4 class="text-white mb-2">Editar</h4>
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <!--ROW 1 START-->
                                    <div class="col-sm-4">
                                        <label for="">Nombre:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i style="font-size:20px;" class="fas fa-stamp"></i></span>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                value="{{ $user->name}}">
                                            @error('name')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="">Apellido:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" value="{{ $user->lastname }}">
                                            <span class="input-group-text"><i style="font-size:20px;" class="fas fa-stamp"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="">Usuario:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="username" class="form-control" placeholder="Doe23" value="{{$user->username}}">
                                            <span class="input-group-text"><i style="font-size:20px;" class="fas fa-stamp"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--ROW 2 START-->
                                    <div class="col-sm">
                                        <label for="">Correo:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i style="font-size:20px;" class="fas fa-stamp"></i></span>
                                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}">
                                            @error('email')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <label for="">Documento de Identidad:</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control @error('identification_document') is-invalid @enderror" name="identification_document" value="{{$user->identification_document}}" placeholder="|2345678">
                                            <span class="input-group-text"><i style="font-size:20px;" class="fas fa-stamp"></i></span>
                                            @error('identification_document')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <label for="">Tipo de Documento:</label>
                                        <br>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="type_document" id="flexRadioDefaults1" value="CC." >
                                            <label class="form-check-label" for="inlineRadios1">CC.</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="type_document" id="flexRadioDefaults2" value="Pasaporte" >
                                            <label class="form-check-label" for="inlineRadios2">Pasaporte</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="type_document" id="flexRadioDefaults3" value="C.E" >
                                            <label class="form-check-label" for="inlineRadios3">C.E</label>
                                        </div>
                                    </div>
                                </div>
                                <!--ROW 1 END-->
                                <div class="row">
                                    <!--ROW 2 START-->
                                    <div class="col-sm">
                                        <label for="">Fecha de Nacimiento:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" ><i style="font-size:20px;" class="fas fa-stamp" type="date"></i></span>
                                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror" value="{{$user->birthdate}}" aria-label="Amount (to the nearest dollar)" placeholder="23/05/1996" name="birthdate">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <label for="">Genero:</label>
                                        <br>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Masculino">
                                            <label class="form-check-label" for="inlineRadio1">Masculino</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault" value="Femenino">
                                            <label class="form-check-label">Femenino</label>
                                        </div>
                                    </div>
                                    <div class="col-sm"></div>
                                </div>
                                <!--ROW 3 END-->
                                <div class="botones mt-2">
                                    <button type="submit" class="btn btn-success btn-lg" id="guardar">Guardar</button>
                                    <button type="button" class="btn btn-danger btn-lg">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
 
    @include('profile.ui.contacto')

    @include('profile.ui.wallet')

    @include('profile.ui.password')
    
    <!--MODAL cCAMBIAR FOTO-->
    <div class="modal fade" id="Modalphoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">actualizar foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('photo.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row d-flex justify-content-center">
                        <div class="col-sm-5 capa-exterior ">
                            <label for="hiddenBtn" class="choose-btn capa-interior" id="chooseBtn"><i class="fas fa-upload rosado"></i> Subir Foto</label>
                            <input type="file" id="hiddenBtn" type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}">
                            <br>

                            @error('image')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                            @enderror

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

    <style>
        i {
            color: #EBAAFF;
        }
        input[type="date"]::-webkit-calendar-picker-indicator, input[type="time"]::-webkit-calendar-picker-indicator{
            cursor: pointer;
            border-radius: 4px;
            margin-right: 1px;
            opacity: 0.9;
            filter: invert(0.9);
        }

        table {
          width: 100%;
          border-collapse: collapse;
          margin: 50px auto;
          border: 1px solid #EBAAFF;

        }

        thead {
          height: 100px;
        }

        tbody {
          height: 200px;
        }

        th {
          background: #3498db;
          color: white;
          font-weight: bold;

        }

        td,
        th {
          padding: 10px;
          border: 1px solid #EBAAFF;
          text-align: center;
          font-size: 18px;
        }

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {

          table {
            width: 100%;
            height: auto;
          }

          table,
          thead,
          tbody,
          th,
          td,
          tr {
            display: block;
            height: auto;
          }

          td,
          th {
            padding: 10px;
            border: 1px solid #EBAAFF;
            text-align: left;
            font-size: 18px;
          }

          thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
          }

          tr {
            border: 1px solid #EBAAFF;
          }

          td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #EBAAFF;
            position: relative;
            padding-left: 50%;
          }

          td:before {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            content: attr(data-column);
            color: #EBAAFF;
          }
        }
    </style>
    <script>
        let btnModalphoto = document.querySelector('#btnModalphoto');
        btnModalphoto.addEventListener("click", function(event) {
            let myModal = new bootstrap.Modal(document.getElementById('Modalphoto'), {
                keyboard: false
            })
            myModal.show();
        }, false);
    </script>
@endsection
