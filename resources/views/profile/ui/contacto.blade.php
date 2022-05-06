<!--Información Personal end-->

<div class="title mb-5 mt-3">
    <p class="rosado">Información de Contacto</p>
    <div class="row">
        <div class="col-lg-12 col-12 order-2 order-lg-1">
            <div class="card">
                <form method="POST" action="{{ route('contacto.update') }}" enctype="multipart/form-data" novalidate>
                  @csrf
                    <div class="card-body">
                        <h4 class="text-white mb-2">Editar</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">País:</label>
                                <div class="input-group mb-3">
                                    <select id="countrie_id" class="rounded form-control" name="countrie">
                                        <option disabled selected >--seleccione un Pais--</option>
                                        @foreach($country as $item)
                                            <option @if($user->countrie_id == $item->id) selected @endif value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-text fw-bold text-white">Browse</span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="">Ciudad:</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="city" class="form-control  @error('city') is-invalid @enderror " placeholder="Bogotá" value="{{$user->city}}">
                                    @error('city')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <label for="">Código Postal:</label>
                                <div class="input-group mb-3">
                                    <input type="enum" name="code_postal" class="form-control  @error('code_postal') is-invalid @enderror " placeholder="110111" value="{{$user->code_postal}}" >
                                    @error('code_postal')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="">Teléfono:</label>
                                <div class="input-group mb-3">
                                     <select id="prefix" class="custom-select rounded" name="prefix">
                                        <option disabled selected >COL +58</option>
                                        @foreach($prefix as $item)
                                            <option  @if($user->prefix_id == $item->prefix) selected @endif 
                                                value="{{$item->prefix}} ">
                                                {{$item->name}} {{$item->prefix}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="enum" name="phone" class="form-control   @error('phone') is-invalid @enderror " placeholder="3107658734" value="{{$user->phone}}">
                                    @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm">
                                <label for="">Dirección:</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control  @error('direction') is-invalid @enderror" placeholder="Calle 4A #63tv - 98" value="{{$user->direction}}" name="direction">
                                    @error('direction')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm"></div>
                        </div>
                        <div class="col-sm"></div>
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
