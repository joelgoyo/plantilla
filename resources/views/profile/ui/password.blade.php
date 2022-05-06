<div class="title mb-5 mt-3">
    <p class="rosado">Cambiar Contraseña</p>
    <div class="row">
      <div class="col-lg-12 col-12 order-2 order-lg-1">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('contraseña.update') }}" novalidate>
                  @csrf
                    <h4 class="text-white mb-2">Editar</h4>
                    <div class="row"> 
                        <!--ROW 1 START-->
                       <div class="col-sm-4">
                            <label for="">Contraseña Actual:</label>
                            <div class="input-group mb-3">
                                {{-- <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password"> --}}
                                <input id="password" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password" value="{{ $user->password}}">
                                @error('current_password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="col-sm-4">
                            <label for="">Cambiar Contraseña:</label>
                            <div class="input-group mb-3">
                                {{-- <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"> --}}
                                <input id="new_password" type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" autocomplete="current-password">
                                @error('new_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="">Confirmar Contraseña:</label>
                            <div class="input-group mb-3">
                                {{-- <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password"> --}}
                                <input id="confirm_password" type="password" name="confirm_password" class="form-control @error('new_confirm_password') is-invalid @enderror" autocomplete="current-password">
                                @error('confirm_password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <!--ROW 1 END-->
                        <div class="botones mt-2">
                            <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                            <button type="button" class="btn btn-danger btn-lg">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<!--Cambiar Contraseña end-->
