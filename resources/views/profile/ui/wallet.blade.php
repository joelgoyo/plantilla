<div class="title mb-5 mt-3">
   
    <div class="row">
        <div class="col-lg-12 col-12 order-2 order-lg-1">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('wallet.edit')}}" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <h4 class="text-white mb-2">Establecer pin</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Pin de seguridad:</label>
                                <div class="input-group mb-3">
                                    <input type="password" maxlength="6" name="code_security" class="form-control" placeholder="xxxxxx">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Confirmar pin de seguridad:</label>
                                <div class="input-group mb-3">
                                    <input type="password" maxlength="6" name="code_security_confirm" class="form-control" placeholder="xxxxxx">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="">Contraseña:</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="xxxxxxxxxx">
                                </div>
                            </div>
                        </div>

                        <div class="botones mt-2">
                            <button type="submit" class="btn btn-success btn-lg">Guardar</button>
                            <button type="button" class="btn btn-danger btn-lg">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 