@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
@endsection

@section('content')
<style>
  .image {
    width: 100%;
    object-fit: cover;
    height: 250px;
  }

  @media only screen and (max-width: 865px) {
    .links {
      display: none;
    }

    .MyEXCELSIOR {
      width: 100%;
      display: flex;
    }
  }
</style>

<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
  <div class="p-2 flex-grow-1 bd-highlight">¡BIENVENIDO!<br>My EXCELSIOR space</div>
  <div class=" bd-highlight btn Referral-text links">Referral Link: <span>{{route('register')}}?referred_id={{Auth::id()}}</span></div>
  <div class="p-2 bd-highlight"><button class="btn rosado Referral-btn" onclick="getlink()">Copiar</button></div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="">
    <div class="card-body text-center banner">
      <video class="img-responsive image" controls autoplay muted loop>
        <source src="{{asset('/Dashboard/DASHBOARD.mp4')}}">
        Su navegador no puede reproducir este formato de video
      </video>
    </div>
  </div>
</div>


@include('components.tranding-view')
<section id="dashboard-analytics">
  <div class="parent">
    <div class="div1">
      <!-- PROGRESO DE MI PLAN  -->
      <div class="card cartas">
        <div class="card-header">
          <div class="d-flex justify-content-start fw-bold h4 text-white">PROGRESO DE MI PLAN</div>
          <div class="d-flex justify-content-end fw-bold h4 text-white">6% Mensual</div>
        </div>
        <div class="card-body text-center mt-6">
          <div style=""></div>
          <!--PROGRESS BAR-->
          <div class="progresscircle blue" data-value='{{Auth::user()->progreso()}}'>
            <span class="progress-left">
              <span class="progress-circle"></span>
            </span>
            <span class="progress-right">
              <span class="progress-circle"></span>
            </span>
            <div class="progress-value">{{round(Auth::user()->progreso(), 2)}}%</div>
          </div>
          <!-- PROGRESS BAR END-->
        </div>
        <div class="card-footer master mt-4">
          <div class="row gy-2">
            <div class="col-6">
              @if($inversion != null)
              <div class="rosado MasterInvestor fw-bold">{{(Auth::user()->paquete())}}</div>
              @else
              <div class=" MasterInvestor rosado text-center">Sin paquete Activo</div>
              @endif
            </div>
            <div class="col-6">
              <div class="d-flex justify-content-end fw-bold text-white h4">Rendimiento actual</div>
            </div>
            <div class="col-6">
              @if($inversion != null)
              <div class="fw-bold text-white h4">U${{$inversion->invested}}</div>
              @else
              <div class="fw-bold text-white h4">U$0</div>
              @endif
            </div>
            <div class="col-6">
              <div class="d-flex justify-content-end fw-bold text-white h4">U${{(Auth::user()->rendimiento())}}</div>
            </div>
          </div>
        </div>
      </div>
      <!-- PROGRESO DE MI PLAN END -->

    </div>
       <!-- CARD BONO INICIO RÁPIDO DIRECTO-->
    <div class="div2">

      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight">
          <div class="w-100 bd-highlight fw-bold text-white">BONO INICIO RÁPIDO DIRECTO</div>
          <div class="flex-shrink-1 bd-highlight">
            <div class="avatar bg-light-success" style="padding: 13.5px;">
              <div class="avatar-content">
                <i class="fas fa-user-check" style="font-size: 20px;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
         @if(Auth::user()->bonoInicio() != null)
          <div class="paragraph fw-bold h4 text-white">U${{(Auth::user()->bonoInicio())}}</div>
        @else
        <div class="paragraph fw-bold h4 text-white">U$0</div>
        @endif
      </div>
    </div>
    <!--CARD BONO INICIO RÁPIDO DIRECTO END -->

    <!-- BONO ACTIVACIÓN MENSUAL -->
    <div class="div3" style="margin-bottom: -1rem">
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight">
          <div class="w-100 bd-highlight fw-bold text-white">BONO ACTIVACIÓN MENSUAL</div>
          <div class="flex-shrink-1 bd-highlight">
            <div class="avatar bg-light-success" style="padding: 13.5px;">
              <div class="avatar-content">
                <i class="fas fa-award" style="font-size: 20px;"></i>
              </div>
            </div>
            <div style="padding-top: 33%"></div>
          </div>
        </div>
        <div class="paragraph fw-bold h4 text-white ">U${{(Auth::user()->Activacion())}}</div>
      </div>
    </div>
    <!-- BONO ACTIVACIÓN MENSUAL END -->

    <!--BONO CARTERA 1%-->
    <div class="div4" style="margin-bottom: -1rem;">
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight">
          <div class="w-100 bd-highlight fw-bold text-white">BONO CARTERA 1%</div>
          <div class="flex-shrink-1 bd-highlight">
            <div class="avatar bg-light-warning" style="padding: 15.5px;">
              <div class="avatar-content">
                <i class="fas fa-chart-pie" style="font-size: 20px;"></i>
              </div>
            </div>
            <div style="padding: 12%"></div>
          </div>
        </div>
        <div class="paragraph fw-bold h4 text-white ">U${{(Auth::user()->cartera())}}</div>
      </div>
    </div>
  </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
@endsection
@section('page-script')

<script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
@endsection

