@extends('layouts/contentLayoutMaster')

{{-- @push('page_js')
<script src="{{asset('assets/js/librerias/vue.js')}}"></script>
<script src="{{asset('assets/js/librerias/axios.min.js')}}"></script>
@endpush
@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush
@push('custom_js')
<script src="{{asset('assets/js/withdraw.js')}}"></script>
@endpush --}}


@section('title', 'Comisiones')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
{{-- <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}"> --}}
@endsection

@section('content')

<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
  <div class=" flex-grow-1 bd-highlight">Wallet<br>Retiro*</div>
  <div class=" bd-highlight ">
    <h2 class="text-white fw-bold">

  </div>
  <div class="avatar bg-light-success p-1 me-auto">
    <div class="avatar-content">
      <i class="fas fa-dollar-sign" style="font-size:25px;" class="avatar-icon"></i>
    </div>
  </div>

  <div class="my-auto ">
    <h2 class="fw-bolder mb-0 text-white">$
      @if(isset($saldoDisponible))
      {{$saldoDisponible}}
      @else
      0
      @endif
    </h2>
    <p class="card-text text-white font-small-3 mb-0">Saldo Actual</p>
  </div>
</div>
</div>

<!-- Statistics card section -->
<section class="row">
  <!-- Miscellaneous Charts -->
  <!--/ Line Chart -->
    <div class="col-lg-12 col-12">
        <div id="logs-list">
	        <div class="col-12">
	          <div class="card">
	            <div class="card-content">
	              	<div class="card-header">
	                	<h4>Wallet</h4>
	             	</div>
	              	<div class="card-body card-dashboard">
		                <div class="table-responsive">
		                    <table class="table  nowrap scroll-horizontal-vertical myTable table-striped w-100">
			                    <thead class="">
			                        <tr class="text-center">
				                        <th>ID</th>
				                        <th>Usuario</th>
				                        <th>ID Usuario</th>
				                        <th>Tipo Transacción</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        @if(isset($wallets))
				                        @foreach ($wallets as $key => $value)
						                    <tr class="text-center">
						                        <td>{{$value->id}}</td>
						                        <td>{{$value->usuarios->name}}</td>
						                        <td>{{$value->user_id}}</td>
						                        <td>
						                          @if ($value->tipo_transaction == 1)
						                          	<span class="badge bg-success">Retiro</span>
						                          @else
						                          	<span class="badge bg-secondary">Comisión</span>
						                          @endif
						                        </td>
						                    </tr>
				                        @endforeach
			                        @endif
			                    </tbody>
		                    </table>
		                </div>
	                </div>
	            </div>
	          </div>
	        </div>
        </div>
    </div>
    <!--/ Line Chart Card -->
</section>
<!--/ Statistics Card section-->

@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
  //datataables ordenes
  $('.myTable').DataTable({
    responsive: true,
    order: [
      [0, 'desc']
    ],
  })
</script>
@endsection