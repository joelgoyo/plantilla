@extends('layouts/contentLayoutMaster')

@section('title', 'Red | Referidos')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">

<style>
    #link {
        border-style: solid !important;
        border-width: 1px;
        border-color: #545454 !important;
    }
</style>
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection

@section('content')

<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
    <div class="flex-grow-1 bd-highlight">MI Equipo <br> Estructura </div>
    <div class="bd-highlight btn Referral-text">Referral Link:<span>{{route('register')}}?referred_id={{Auth::id()}}</span></div>
    <div class="p-2 bd-highlight"><button class="btn rosado Referral-btn" onclick="getlink()">Copiar</button></div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body " style="background-color:#000000!important;">
            <div class="list-group respon" style="background-color:#00020E!important;">
                @foreach ($referidos->where('nivel', 1) as $item)
                    <botton type="hidden" data-bs-toggle="modal"
                            data-bs-target="#ModalReferido{{$item->id}}" id="btnModalReferido" >
                        <a href="#" class="list-group-item list-group-item-action" id="link" style="@if($loop->first || $loop->last ) background-color: #2F284687 !important; @else background-color:#00020E!important; @endif " aria-current="true">

                            <div class="row respon p-0 m-0">
                                <div class="col">
                                    @if ($item->photo == null)
                                    <img src="{{asset('images/portrait/small/avatar-s-8.jpg')}}" alt="Avatar" class="rounded-circle" width="60" height="60" />
                                    @else
                                    <img class="rounded-circle" src="{{ asset('storage/photo-profile/'.$item->photo) }}" alt="Avatar" width="70" height="70">
                                    @endif
                                </div>

                                <div class="col mt-2">
                                    <h4 class=" text-white texto-card-1" style="font-size:15px;">{{$item->name}} </h4>
                                </div>

                                <div class="col mt-2">

                                    @if($item->invertido != null )
                                        <span class="badge bg-secondary {{$item->getClassPackage()}}">{{ $item->paquete()}}</span style="font-size:10px;">
                                    @else
                                        <span class="badge bg-secondary" style="font-size:10px;">Sin Paquetes</span>
                                    @endif
                                </div>
                                <div class="col mt-2">
                                    <p>U$ {{$item->montoTotalInvertido()}}</p>
                                </div>
                                <div class="col mt-2">
                                    <div class="form-check">
                                        @if($item->status == 1)
                                            <div class="col-12 ">
                                                <input class="form-check-input  btn-success rounded-circle" type="radio" name="activo" id="activo" @if($item->status == 1)checked  @endif>
                                                <label class="form-label " for="activo">
                                                    ACTIVO
                                                </label>
                                            </div>                                
                                        @elseif($item->status == 0)
                                            <div class="col-12 ">
                                                <input class="form-check-input  rounded-circle" type="radio" name="activo" id="activo" @if($item->status == 1 ) checked @endif>
                                                <label class="form-check-label " for="activo">
                                                    ACTIVO
                                                </label>
                                            </div>
                                        @endif
                                        <div class="col-12 ">
                                            <p style="font-size:10px;">
                                                @if($item->status == 1 )
                                                    desde {{$item->updated_at->format('d-m-Y')}}
                                                @else
                                                    ----------
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mt-2">
                                     <div class="form-check">
                                        @if($item->status == 0)
                                            <div class="col-12 ">
                                                <input class="form-check-input  btn-primary rounded-circle" type="radio" name="inactivo" id="inactivo" @if($item->status == 0)checked  @endif>
                                                <label class="form-label " for="inactivo">
                                                    INACTIVO
                                                </label>
                                            </div>                                
                                        @elseif($item->status == 1)
                                            <div class="col-12 ">
                                                <input class="form-check-input  rounded-circle" type="radio" name="inactivo" id="inactivo" @if($item->status == 0 ) checked @endif>
                                                <label class="form-check-label " for="inactivo">
                                                    INACTIVO
                                                </label>
                                            </div>
                                        @endif
                                        <div class="col-12 ">
                                            <p style="font-size:10px;">
                                                @if($item->status == 0 )
                                                    desde {{$item->updated_at->format('d-m-Y')}}
                                                @else
                                                    ----------
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col mt-2 directos">
                                    <p class="text-center"><i class="fas fa-user-check rosado" style="background-color: #231F45 !important;border-radius: 100%; "></i> {{$item->countReferidosDirectos()}} Directos</p>
                                </div>
                            </div>
                        </a>
                    </button>
                    <!--MODAL CREAR CATEGORIA-->
                    <div class="modal fade" id="ModalReferido{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="width:80rem;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white" id="exampleModalCenterTitle">Referidos de {{$item->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                               
                                <div class="modal-body">
                                     <div class="list-group ">
                                        @if(count($item->referidos) > 0)
                                            @foreach ($item->referidos->where('nivel', 1) as $item)
                                                <a href="#" class="list-group-item list-group-item-action" id="link" style="@if($loop->first || $loop->last ) background-color: #2F284687 !important; @else background-color:#00020E!important; @endif " aria-current="true">
                                                    <div class="row respon p-0 m-0">
                                                        <div class="col">
                                                            @if ($item->photo == null)
                                                                <img src="{{asset('images/portrait/small/avatar-s-8.jpg')}}" alt="Avatar" class="rounded-circle" width="60" height="60" />
                                                            @else
                                                                <img class="rounded-circle" src="{{ asset('storage/photo-profile/'.$item->photo) }}" alt="Avatar" width="70" height="70">
                                                            @endif
                                                        </div>
                                                        <div class="col mt-2">
                                                            <h4 class=" text-white texto-card-1" style="font-size:15px;">       {{$item->name}} 
                                                            </h4>
                                                        </div>
                                                        <div class="col mt-2">

                                                            @if($item->invertido != null )

                                                                <span class="badge bg-secondary {{$item->getClassPackage()}}">{{ $item->paquete()}}</span style="font-size:10px;">
                                                            @else
                                                                <span class="badge bg-secondary" style="font-size:10px;">Sin Paquetes</span>
                                                            @endif
                                                        </div>
                                                        <div class="col mt-2">
                                                            <p>U$ {{$item->montoTotalInvertido()}}</p>
                                                        </div>
                                                        <div class="col mt-2">
                                                            <div class="form-check">
                                                                @if($item->status == 1)
                                                                    <div class="col-12 ">
                                                                        <input class="form-check-input  btn-success rounded-circle" type="radio" name="activo" id="activo" @if($item->status == 1)checked  @endif>
                                                                        <label class="form-label " for="activo">
                                                                            ACTIVO
                                                                        </label>
                                                                    </div>                                
                                                                @elseif($item->status == 0)
                                                                    <div class="col-12 ">
                                                                        <input class="form-check-input  rounded-circle" type="radio" name="activo" id="activo" @if($item->status == 1 ) checked @endif>
                                                                        <label class="form-check-label " for="activo">
                                                                            ACTIVO
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                <div class="col-12 ">
                                                                    <p style="font-size:10px;">
                                                                        @if($item->status == 1 )
                                                                            desde {{$item->updated_at->format('d-m-Y')}}
                                                                        @else
                                                                            ----------
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mt-2">
                                                             <div class="form-check">
                                                                @if($item->status == 0)
                                                                    <div class="col-12 ">
                                                                        <input class="form-check-input  btn-primary rounded-circle" type="radio" name="inactivo" id="inactivo" @if($item->status == 0)checked  @endif>
                                                                        <label class="form-label " for="inactivo">
                                                                            INACTIVO
                                                                        </label>
                                                                    </div>                                
                                                                @elseif($item->status == 1)
                                                                    <div class="col-12 ">
                                                                        <input class="form-check-input  rounded-circle" type="radio" name="inactivo" id="inactivo" @if($item->status == 0 ) checked @endif>
                                                                        <label class="form-check-label " for="inactivo">
                                                                            INACTIVO
                                                                        </label>
                                                                    </div>
                                                                @endif
                                                                <div class="col-12 ">
                                                                    <p style="font-size:10px;">
                                                                        @if($item->status == 0 )
                                                                        desde {{$item->updated_at->format('d-m-Y')}}
                                                                        @else
                                                                        ----------
                                                                        @endif
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col mt-2 directos">
                                                            <p class="text-center">
                                                                <i class="fas fa-user-check rosado" style="background-color: #231F45 !important;border-radius: 100%; ">
                                                                    
                                                                </i>{{$item->countReferidosDirectos()}} Directos
                                                            </p>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                        <p class="text-center"> {{$item->name}} No tiene referidos en este momento </p>    
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn rosado Referral-btn" data-dismiss="modal" arial-label="close" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn rosado Referral-btn">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
       </div>
    </div>
<div>
@endsection

<style>
    @media only screen and (max-width: 800px) {
        .respon{
            width: 100%;
        }
        .col{
            box-sizing: border-box;

        }
    }
</style>

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
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