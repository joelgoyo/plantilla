@extends('layouts/contentLayoutMaster')

@section('title', 'Educacion')


@section('content')


<div class="MyEXCELSIOR  d-flex bd-highlight rosado mb-3">
    <div class="p-2 flex-grow-1 bd-highlight">Educacion<br>Herramientas de Marketing</div>
</div>
<div class="content-body mb-5 mt-2">
    <div class="card">
        <div class="card-header">
            <h4>Carpetas</h4>
            <a type="button" href="{{ route('education.create') }}" class="btn rosado Referral-btn">Agregar Nuevo</a>
        </div>
        <div class="container mt-2">
            <div class="row">
              @if(count($educations) > 0)
                @foreach ($educations as $item)
                <div class="card container-fluid cards-border" style="width: 20rem;">
                    <video src="{{asset('/storage/education/'.$item->video)}}" controls width="270" height="300" class="m-0 p-0" style="margin-left:-0.7rem !important; margin-top:-5rem !important;"></video>
                    <a target="_blank" href="{{asset('/storage/education/'.$item->video)}}">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <strong>Nombre:</strong>
                        <p class="fw-bold">
                            {{$item->title}}
                        </p>

                      <br>
                    </div>
                    </a>
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
@endsection
