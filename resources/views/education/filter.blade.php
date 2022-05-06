@extends('layouts.contentLayoutMaster')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush

@section('content')
<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
  <div class="p-2 flex-grow-1 bd-highlight">Educacion<br>Herramientas de Marketing</div>
</div>

<div class="content-body mb-5 mt-2">
  <div class="card">
    <div class="card-header">
      <h4>Categoria:</h4>

      <div class="container mt-2">
        <div class="row">
          @foreach ($education as $item)
          <div class="card container-fluid cards-border" style="width: 20rem;">
            <video src="{{asset('/storage/education/'.$item->video)}}" controls width="270" height="300" class="m-0 p-0" style="margin-left:-0.7rem !important; margin-top:-5rem !important;"></video>
            <a target="_blank" href="{{asset('/storage/education/'.$item->video)}}">
            <div class="card-header">
            </div>
            <div class="card-body">
                <strong>Nombre:</strong>
                <p class="fw-bold">
                    {{$item->video}}
                </p>

              <br>
            </div>
            </a>
          </div>

          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .cards-border:hover {
    border: 1px solid #EBAAFF;
  }
</style>
@endsection

