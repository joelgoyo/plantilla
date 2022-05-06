@extends('layouts.contentLayoutMaster')

@push('vendor_css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endpush

@push('page_vendor_js')
<script src="{{asset('assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/app-assets/vendors/js/extensions/polyfill.min.js')}}"></script>
@endpush


<style>
    div.container-fluid {
        -webkit-transform: scale(1, 1);
        -webkit-transition-timing-function: ease-out;
        -webkit-transition-duration: 250ms;
        -moz-transform: scale(1, 1);
        -moz-transition-timing-function: ease-out;
        -moz-transition-duration: 250ms;
    }

    div.container-fluid:hover {
        -webkit-transform: scale(1.12, 1.12);
        -webkit-transition-timing-function: ease-out;
        -webkit-transition-duration: 100ms;
        -moz-transform: scale(1.12, 1.12);
        -moz-transition-timing-function: ease-out;
        -moz-transition-duration: 100ms;
    }
</style>

@section('content')
<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
    <div class="p-2 flex-grow-1 bd-highlight">Educacion<br>Herramientas de Marketing</div>
</div>
<div class="content-body mb-5 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>Categorias</h4>

            <div class="container mt-2">
                <div class="row">
                    @if(count($educations) > 0)
                    @foreach ($educations as $item)
                    <div class="card container-fluid cards-border" style="width: 20rem;">
                        <a href="{{route('education.filter')}}">
                            <div class="card-header">
                                <div class="logo" style="margin:auto;">
                                    <i style="color: #6e6b7b;" class="fa fa-folder fa-6x mt-1"></i>
                                </div>
                            </div>
                        </a>
                        <div class="card-body mt-2">
                            <strong>Nombre:</strong>
                            <p class="fw-bold">
                                {{$item->name}}
                            </p>
                            <br>

                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-center mb-5 text-center">No hay educacion disponibles</p>
                @endif
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
