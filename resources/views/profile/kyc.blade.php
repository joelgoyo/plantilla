@extends('layouts/contentLayoutMaster')

@section('content')
<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
    <div class="p-2 flex-grow-1 bd-highlight">MI PERFIL<br>Verificación KYC</div>
</div>
<section>
    @if($user->kyc != null)
        @if($user->kyc->status == null)
            <form method="POST" action="{{ route('kyc.store') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="title">
                    <p>Seleccione el tipo de documento:</p>
                </div>
                <div class="Grid-kyc">
                    <div class="area1">
                        <div class="card cards-border">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Tarjeta de Identificacion" id="flexCheckDefault1">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Tarjeta de Identificación</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area2 ">
                        <div class="card cards-border ">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Pasaporte" id="flexCheckDefault2">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Pasaporte</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area3">
                        <div class="card cards-border">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Licencia de Conducir" id="flexCheckDefault3">
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Licencia de Conducir</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="area4">
                        <div class="card">
                            <div class="card-header">
                                <p>Cargar el documento de identidad*</p>
                            </div>
                            <div class="card-body p-3">

                                <div id="contenedor">
                                    <div class="logo" id="gallery">
                                        <i class="far fa-address-card rosado" id="logos" style="font-size:120px;" onclick="document.getElementById('fileID').click(); return false;" href="#"></i>
                                    </div>
                                  
                                        <input type="file" id="imgUpload" name="photo_forward" multiple accept="image/*" onchange="filesManager(this.files)">
                                        <label class="upload" for="imgUpload" id="label"> <i class="fas fa-upload rosado" style="font-size:20px;"></i> <span>Cargar página frontal</span></label>

                                   
                                </div> 
                                <br>
                                <div id="contenedor">
                                    <div class="logos" id="gallery2">
                                        <i class="far fa-credit-card rosado" id="logos2"  style="font-size:120px;" onclick="document.getElementById('file2ID').click(); return false;" href="#">  
                                        </i>
                                    </div>
                                 
                                        <input type="file" id="imgUploads" name="photo_rear" multiple accept="image/*" onchange="filesManagers(this.files)">
                                        <label class="upload" for="imgUploads" id="label2"> <i class="fas fa-upload rosado" style="font-size:20px;"></i> <span>Cargar página posterior</span></label>
                                    
                                </div> 
                            </div>
                            <div class="foot p-1">
                                <p>*Cargue el archivo el archivo .jpg .jpeg .png y que no exceda los 5 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="botones mb-2">
                        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                        <button type="button" class="btn btn-danger btn-lg">Cancelar</button>
                    </div>
                </div>
            </form>
        @elseif($user->kyc->status == 2)
            <form method="POST" action="{{ route('kyc.update') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="id" value="{{$user->kyc->id}}">
                <input type="hidden" name="status" value="0">
                <div class="title">
                    <p>Seleccione el tipo de documento:</p>
                </div>
            
                <div class="Grid-kyc">
                    <div class="area1">
                        <div class="card cards-border">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Tarjeta de Identificacion" id="flexCheckDefault1">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Tarjeta de Identificación</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area2 ">
                        <div class="card cards-border ">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Pasaporte" id="flexCheckDefault2">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Pasaporte</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area3">
                        <div class="card cards-border">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Licencia de Conducir" id="flexCheckDefault3">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Licencia de Conducir</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area4">
                        <div class="card">
                            <div class="card-header">
                                <p>Cargar el documento de identidad*</p>
                            </div>
                            <div class="card-body p-3">
                                <div id="contenedor">
                                    <div class="logo" id="gallery">
                                        <i class="far fa-address-card rosado" id="logos" style="font-size:120px;" onclick="document.getElementById('fileID').click(); return false;" href="#"></i>
                                    </div>
                                    <input type="file" id="imgUpload" name="photo_forward" multiple accept="image/*" onchange="filesManager(this.files)">
                                    <label class="upload" for="imgUpload" id="label"> <i class="fas fa-upload rosado" style="font-size:20px;"></i> <span>Cargar página frontal</span></label>
                                </div> 
                                <br>
                                <div id="contenedor">
                                    <div class="logos" id="gallery2">
                                        <i class="far fa-credit-card rosado" id="logos2"  style="font-size:120px;" onclick="document.getElementById('file2ID').click(); return false;" href="#">  
                                        </i>
                                    </div>
                                    <input type="file" id="imgUploads" name="photo_rear" multiple accept="image/*" onchange="filesManagers(this.files)">
                                    <label class="upload" for="imgUploads" id="label2"> <i class="fas fa-upload rosado" style="font-size:20px;"></i> <span>Cargar página posterior</span></label>    
                                </div> 
                            </div>
                            <div class="foot p-1">
                                <p>*Cargue el archivo el archivo .jpg .jpeg .png y que no exceda los 5 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="botones mb-2">
                        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                        <button id="boton01" type="button" class="btn btn-danger btn-lg">Cancelar</button>
                    </div>
                </div>
            </form>
        @endif
        @else
            <form method="POST" action="{{ route('kyc.store') }}" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="title">
                    <p>Seleccione el tipo de documento:</p>
                </div>
                <div class="Grid-kyc">
                    <div class="area1">
                        <div class="card cards-border">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Tarjeta de Identificacion" id="flexCheckDefault1">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Tarjeta de Identificación</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area2 ">
                        <div class="card cards-border ">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Pasaporte" id="flexCheckDefault2">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Pasaporte</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="area3">
                        <div class="card cards-border">
                            <div class="card-header mb-5">
                                <div class="col-sm d-flex justify-content-end">
                                    <input name="type_kyc" class="form-check-input" type="radio" value="Licencia de Conducir" id="flexCheckDefault3">
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <i class="fas fa-stop" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="col-sm">Licencia de Conducir</div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="area4">
                        <div class="card">
                            <div class="card-header">
                                <p>Cargar el documento de identidad*</p>
                            </div>
                            <div class="card-body p-3">
                                <div id="contenedor">
                                    <div class="logo" id="gallery">
                                        <i class="far fa-address-card rosado" id="logos" style="font-size:120px;" onclick="document.getElementById('fileID').click(); return false;" href="#"></i>
                                    </div>
                                    <input type="file" id="imgUpload" name="photo_forward" multiple accept="image/*" onchange="filesManager(this.files)">
                                    <label class="upload" for="imgUpload" id="label"> <i class="fas fa-upload rosado" style="font-size:20px;"></i> <span>Cargar página frontal</span></label>
                                </div> 
                                <br>
                                <div id="contenedor">
                                    <div class="logos" id="gallery2">
                                        <i class="far fa-credit-card rosado" id="logos2"  style="font-size:120px;" onclick="document.getElementById('file2ID').click(); return false;" href="#">  
                                        </i>
                                    </div>
                                    <input type="file" id="imgUploads" name="photo_rear" multiple accept="image/*" onchange="filesManagers(this.files)">
                                    <label class="upload" for="imgUploads" id="label2"> <i class="fas fa-upload rosado" style="font-size:20px;"></i> <span>Cargar página posterior</span></label>
                                
                                </div> 
                            </div>
                            <div class="foot p-1">
                                <p>*Cargue el archivo el archivo .jpg .jpeg .png y que no exceda los 5 MB</p>
                            </div>
                        </div>
                    </div>
                    <div class="botones mb-2">
                        <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                        <button id="boton01"  type="button" class="btn btn-danger btn-lg">Cancelar</button>
                    </div>
                </div>
            </form>
        @endif
</section>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $("#boton01").click(function () {
       setTimeout(function(){ window.location = '{{route("profile.kyc")}}'; });


    });
</script>

@endsection

