@extends('layouts/contentLayoutMaster')

@section('title', 'Tienda')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<div id="adminServices">
    <div class="MyEXCELSIOR  d-flex bd-highlight rosado ">
        <div class="flex-grow-1 bd-highlight">Membresias Excelsior<br>Licencia de operación</div>
    </div>

    <div class="card Referral-btn mb-2 mt-5 col-sm-6" style="margin: auto;">
        <div class="card-body">
            <div class="row align-items-center mt-2 mb-2">
                <div class="col">
                    <i class="fas fa-power-off ms-3" style="font-size: 50px; color: #EBAAFF;"></i>
                </div>
                <div class="col rosado text-end me-2 fw-bold" style="font-size: 21px;">
                    LICENCIA OPERACIÓN EXCELSIOR
                </div>
                <div class="col">
                    <span class="h4 fw-bold" style="font-size:29px; color: #EBAAFF;">U$150</span>
                    <br>
                    <span class="rosado text-nowrap" style="font-size: 18px;">Costo anual</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-1">
        <div class="card-header text-white">
            Selecciona
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 ">
                    <div class="card border border-primary package-size" style="height:32rem">
                        <img class="card-img-top" src="{{asset('/photo-market/freshman-investor.png')}}" style="width: 150px;">
                        <div class="">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-7 align-self-center">
                                    <h4 class="freshman me-3" style="font-size:18px; text-align:right;">FRESHMAN INVESTOR</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="text-center">U$500 - U$4900</h5>
                            <div class="row">
                                <p style="font-size:11.7px;">
                                    <i class="fas fa-desktop" style="color: #AAFFCF"></i> Rendimiento mensual hasta el 6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i>
                                </p>
                                <p>
                                    <i class="fas fa-check" style="color:#AAFFCF;"></i>Activación mensual U$12
                                </p>
                            </div>
                        </div>
                        <form action="{{route('shop.transaction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="package" value="1">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-primary text-white mb-2">Activar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 ">
                    <div class="card border border-primary package-size" style="height:32rem">
                        <img class="card-img-top" src="{{asset('/photo-market/junior-investor.png')}}" style="width: 150px;">
                        <div class="">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-7 align-self-center">
                                    <h4 class="junior me-3" style="font-size:18px; color:#AAF6FF; text-align:right;">JUNIOR INVESTOR
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="card-body">
                            <h5 class="text-center">U$5000 - U$14900</h5>
                            <div class="row">
                                <p style="font-size:11.7px;">
                                    <i class="fas fa-desktop" style="color: #AAF6FF"></i> Rendimiento mensual hasta el 6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i>
                                </p>
                                <p><i class="fas fa-check" style="color:#AAF6FF;"></i>Activación mensual U$20
                                </p>
                            </div>
                        </div>
                        <form action="{{route('shop.transaction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="package" value="2">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-primary text-white mb-2">Activar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 ">
                    <div class="card border border-primary package-size" style="height:32rem">
                        <img class="card-img-top" src="{{asset('/photo-market/senior-investor.png')}}" style="width: 150px;">
                        <div class="">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-7 align-self-center">
                                    <h4 class="senior me-3" style="font-size:18px; color:#FFE6AA; text-align:right;">SENIOR INVESTOR</h4>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                        <div class="card-body">
                            <h5 class="text-center">U$15000 - U$29900</h5>
                            <div class="row">
                                <p style="font-size:11.7px;">
                                    <i class="fas fa-desktop" style="color:#FFE6AA;"></i> Rendimiento mensual hasta el 6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i>
                                </p>
                                <p><i class="fas fa-check" style="color:#FFE6AA;"></i>Activación mensual U$35</p>

                            </div>
                        </div>
                        <form action="{{route('shop.transaction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="package" value="3">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-primary text-white mb-2">Activar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card border border-primary package-size" style="height:32rem">
                        <img class="card-img-top" src="{{asset('/photo-market/master-investor.png')}}" style="width: 150px;">
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-7 align-self-center">
                                    <h5 class="master me-3" style="font-size:18px; color:#FFAACC; text-align:right;">MASTER INVESTOR</h5>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h5 class="text-center">U$30000 - U$49900</h5>
                            <div class="row">
                                <p style="font-size:11.7px;">
                                    <i class="fas fa-desktop" style="color:#FFAACC;"></i> Rendimiento mensual hasta el 6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i>
                                </p>
                                <p><i class="fas fa-check" style="color:#FFAACC;,"></i>Activación mensual U$50</p>
                            </div>
                        </div>
                        <form action="{{route('shop.transaction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="package" value="4">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-primary text-white mb-2">Activar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 ">
                    <div class="card border border-primary package-size" style="height:32rem">
                        <img class="card-img-top" src="{{asset('/photo-market/masterpro-investor.png')}}" style="width: 150px;">
                        <div class="">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-7 align-self-center">
                                    <h4 class="master-pro me-2" style="font-size:18px; color:#FF8B8B; text-align:right;">MASTER PRO INVESTOR</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="text-center">U$50000 - U$149000</h5>
                            <div class="row">
                                <p style="font-size:11.7px;">
                                    <i class="fas fa-desktop" style="color:#FF8B8B;"></i> Rendimiento mensual hasta el 6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i>
                                </p>
                                <p><i class="fas fa-check" style="color:#FF8B8B;"></i>Activación mensual U$80</p>
                            </div>
                        </div>
                        <form action="{{route('shop.transaction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="package" value="5">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-primary text-white mb-2">Activar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 ">
                    <div class="card border border-primary package-size" style="height:32rem">
                        <img class="card-img-top" src="{{asset('/photo-market/excelsior-investor.png')}}" style="width: 150px;">
                        <div class="">
                            <div class="row">
                                <div class="col-5"></div>
                                <div class="col-7 align-self-center">
                                    <h4 class="excelsior me-3" style="font-size:18px; color:#EBAAFF; text-align:right;">EXCELSIOR INVESTOR</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="text-center">U$150000 - U$299000</h5>
                            <div class="row">
                                <p style="font-size:11.7px;">
                                    <i class="fas fa-desktop" style="color:#EBAAFF;"></i> Rendimiento mensual hasta el 6% <i class="fa fa-arrow-up fa-sm" style="color:#14B76E;"></i>
                                </p>
                                <p><i class="fas fa-check" style="color:#EBAAFF;"></i>Activación mensual U$100
                                </p>
                            </div>
                        </div>
                        <form action="{{route('shop.transaction')}}" method="POST">
                            @csrf
                            <input type="hidden" name="package" value="6">
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-outline-primary text-white mb-2">Activar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
<!-- Page js files -->
@endsection