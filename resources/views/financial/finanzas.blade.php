@extends('layouts/contentLayoutMaster')

@section('content')
<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
  <div class="p-2 flex-grow-1 bd-highlight">Finanzas<br>Mis ingresos</div>
  <div class="bd-highlight btn Referral-text">Referral Link: <span>{{route('register')}}?referred_id={{Auth::id()}}</span></div>
  <div class="p-2 bd-highlight"><button class="btn rosado Referral-btn" onclick="getlink()">Copiar</button></div>
</div>

<section class="">

  <div class="Grid-Finanza">
    <div class="areas1">

      <!-- PROGRESO DE MI PLAN  -->
      <div class="card cartas" style="height: 95%;">
        <div class="card-header">
          <div class="d-flex justify-content-start fw-bold h4 text-white">PROGRESO DE MI PLAN</div>
          <div class="d-flex justify-content-end fw-bold h4 text-white">6% Mensual</div>
        </div>
        <div class="card-body mt-2 text-center">
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
        <div class="card-footer master mb-2 mt-2">
          <div class="row gy-2">
            <div class="col-6">
                @if($inversion != null)
                <div class="rosado MasterInvestor fw-bold">{{(Auth::user()->paquete())}}</div>
              @else
                <div class="mb-1 MasterInvestor rosado text-center">Sin paquete Activo</div>
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
        <!-- PROGRESO DE MI PLAN  END-->
      </div>
    </div>

    <div class="areas2">
      <!-- BONO INICIO RÁPIDO INDIRECTO  -->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold text-white">BONO INICIO RÁPIDO INDIRECTO</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-rosado me-1" style="padding: 10px;">
              <div class="avatar-content">
                <i class="fas fa-user-check" style="font-size: 20px;color:#EBAAFF;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        @if(Auth::user()->bonoIndirecto() != null)
          <div class="paragraph fw-bold h4 text-white">                                          U${{(Auth::user()->bonoIndirecto())}}
          </div>
        @else
          <div class="paragraph fw-bold h4 text-white">
            U$0
          </div>
        @endif
      </div>
      <!-- BONO INICIO RÁPIDO INDIRECTO  END -->
    </div>

    <div class="areas3">
      <!-- BONO BONO ACTIVACIÓN MENSUAL  -->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold text-white">BONO ACTIVACIÓN MENSUAL</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-success me-1" style="padding: 10px;">
              <div class="avatar-content">
                <i class="fas fa-award" style="font-size: 20px;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="paragraph fw-bold h4 text-white">U${{(Auth::user()->Activacion())}}</div>
      </div>
      <!-- BONO BONO ACTIVACIÓN MENSUAL END -->
    </div>
    <div class="areas4">
      <!-- BONO CARTERA 1% -->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold text-white">BONO CARTERA 1%</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-warning me-1" style="padding: 10px;">
              <div class="avatar-content">
                <i class="fas fa-chart-pie" style="font-size: 20px;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="paragraph fw-bold h4 text-white">U${{(Auth::user()->cartera())}}</div>
      </div>
      <!-- BONO CARTERA 1% END-->

    </div>
    <div class="areas5">
      <!-- INGRESOS TOTALES-->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold text-white">INGRESOS TOTALES</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-success me-1" style="padding: 10px;">
              <div class="avatar-content">
                <i class="fas fa-dollar-sign" style="font-size: 25px;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="paragraph fw-bold h4 text-white">U${{(Auth::user()->disponible())}}
        </div>
      </div>
      <!-- INGRESOS TOTALES END-->
    </div>
    <div class="areas6">
      <!-- DISPONIBLE-->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold text-white">DISPONIBLE</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-rosado me-1" style="padding: 10px;">
              <div class="avatar-content">
                <i class="fas fa-suitcase" style="font-size: 20px;color:#EBAAFF;"></i>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="paragraph fw-bold h4 text-white">U${{(Auth::user()->totalIngresos())}}</div>
      </div>
      <!-- DISPONIBLE END-->
    </div>
    <div class="areas7">
      <!-- BONO INICIO RÁPIDO DIRECTO-->
      <div class="card p-2 cartas">
        <div class="d-flex bd-highlight mb-2">
          <div class="w-100 bd-highlight fw-bold text-white">BONO INICIO RÁPIDO DIRECTO</div>
          <div class="flex-shrink-1 bd-highlight ">
            <div class="avatar bg-light-success me-1" style="padding: 10px;">
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
      <!-- BONO INICIO RÁPIDO DIRECTO END-->
    </div>
  </div>

</section>


@endsection