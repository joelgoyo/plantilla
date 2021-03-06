@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

<style>
    #video {
        position: fixed;
        right: 0;
        width: auto;
        height: auto;
        z-index: -10;
        min-width: 100%;
        min-height: 100%;
        visibility: visible;
        background-size: cover;
    }
</style>
@section('content')
<video id="video" loop autoplay preload muted>
    <source src="{{asset('Dashboard/LOGIN_v1.mp4')}}" />
</video>

<div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">
        <!-- Register v1 -->
        <div class="card mb-0" style="border: 2px solid #2d3336;opacity:0.8; background-color:black;">
            <div class="card-body">
                <a href="#" class="brand-logo">
                    <img src="{{asset('Dashboard/IMAGOEXCELESIOR-19/IMAGOEXCELESIOR-19.png')}}" alt="">
                </a>
                <h2 class="rosado text-center" style="font-weight:bold;letter-spacing:4px;">BIENVENIDOS</h2>

                <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
                    @csrf
                    @if ( request()->referred_id != null )
                        <input type="hidden" name="referred_id" value="{{request()->referred_id}}">
                    @else
                        <input type="hidden" name="referred_id">
                    @endif

                    <label for="register-username" class="form-label">Nombre de usuario</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-username" name="name" placeholder="johndoe" aria-describedby="register-username" tabindex="1" autofocus value="{{ old('name') }}" />
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="register-email" class="form-label">Correo</label>
                    <div class="input-group mb-1">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="register-email" name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2" value="{{ old('email') }}" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="register-password" class="form-label">Contrase??a</label>
                    <div class="input-ggroup mb-1">
                        <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                            <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="register-password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <label for="register-password-confirm" class="form-label">Confirmar Contrase??a</label>
                    <div class="input-group mb-1">
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="register-password-confirm" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="register-password" tabindex="3" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>

                    <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="register-privacy-policy" tabindex="4" />
                            <label class="form-check-label" for="register-privacy-policy">
                                Acepto las pol??tica de <a href="#" class="rosado fw-bold">privacidad y los t??rminos</a>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn rosado Referral-btn w-100" tabindex="5">Registrarse</button>
                </form>
                <p class="text-center mt-2">
                    <span class="btn">Ya tienes una cuenta?</span>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}">
                            <span class="rosado fw-bold">Iniciar sesi??n</span>
                        </a>
                    @endif
                </p>
            </div>
        </div>
         <div class="title mt-3 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="286.477" height="12.82" viewBox="0 0 286.477 12.82"><defs><style>.a{fill:#ebaaff;}</style></defs><path class="a" d="M30.4,78.2H30V91.02h.974V78.2H30.4Z" transform="translate(-30 -78.2)"/><path class="a" d="M67.482,83.2a2.331,2.331,0,0,0-.97-.591,4.613,4.613,0,0,0-1.5-.215H60.56v9.816h4.455a4.849,4.849,0,0,0,1.511-.2,2.339,2.339,0,0,0,.985-.58,1.876,1.876,0,0,0,.476-.91,4.555,4.555,0,0,0,.1-.988V85.12a4.3,4.3,0,0,0-.111-1A2.027,2.027,0,0,0,67.482,83.2ZM65.015,91.24H61.534V83.361h3.481a3.678,3.678,0,0,1,1.146.143,1.457,1.457,0,0,1,.6.358,1.11,1.11,0,0,1,.269.5,3.162,3.162,0,0,1,.086.752v4.419a3.319,3.319,0,0,1-.079.752,1.01,1.01,0,0,1-.258.48,1.454,1.454,0,0,1-.591.329A3.939,3.939,0,0,1,65.015,91.24Z" transform="translate(-49.616 -80.894)"/><path class="a" d="M109.695,82.4h-.4v9.816h6.428v-.974h-5.454V87.729h4.1v-.974h-4.1V83.374h5.454V82.4h-6.023Z" transform="translate(-80.896 -80.896)"/><path class="a" d="M154.135,82.4h-.4v9.816h.974v-3.9h3.8v-.974h-3.8V83.374h5.157V82.4h-5.726Z" transform="translate(-109.422 -80.896)"/><path class="a" d="M195.275,82.4h-.4v.974h2.586v7.868H194.87v.974h6.113v-.974H198.43V83.374h2.553V82.4h-5.708Z" transform="translate(-135.829 -80.896)"/><path class="a" d="M245.161,86.523h0L244.008,83.8a4.426,4.426,0,0,0-.469-.877,1.25,1.25,0,0,0-1.1-.487H240.8a1.314,1.314,0,0,0-1.124.462,3.939,3.939,0,0,0-.469.877l-1.074,2.736a5.262,5.262,0,0,0-.229.827,5.11,5.11,0,0,0-.082.938V92.22h.974V89.355h5.7V92.22h.974V88.281a5.042,5.042,0,0,0-.082-.935,5.7,5.7,0,0,0-.226-.824Zm-4.734-3.012c.05-.075.175-.115.358-.115h1.637c.254,0,.315.086.333.115a4.052,4.052,0,0,1,.358.655l1.146,2.707a5.328,5.328,0,0,1,.172.648,4.152,4.152,0,0,1,.068.759v.111h-5.7v-.111a4.155,4.155,0,0,1,.068-.759,5.337,5.337,0,0,1,.175-.659l1.074-2.725A3.394,3.394,0,0,1,240.427,83.511Z" transform="translate(-163.399 -80.918)"/><path class="a" d="M293.489,82.4h-.4v6.381l-5.436-6.113h0a1.383,1.383,0,0,0-.2-.168.612.612,0,0,0-.34-.1.627.627,0,0,0-.376.133.566.566,0,0,0-.226.473v9.228h.974V83.947l5.615,6.3v1.97h.974V82.4Z" transform="translate(-194.652 -80.896)"/><path class="a" d="M338.213,82.4a3.527,3.527,0,0,0-2.41.609,2.619,2.619,0,0,0-.663,1.98v4.655a2.585,2.585,0,0,0,.652,1.945,3.533,3.533,0,0,0,2.421.612H341.4v-.974h-3.191c-1.171,0-1.586-.218-1.73-.358a1.638,1.638,0,0,1-.358-1.235V84.978a1.651,1.651,0,0,1,.383-1.261,2.678,2.678,0,0,1,1.715-.358h3.191V82.4h-3.191Z" transform="translate(-225.868 -80.896)"/><path class="a" d="M379.335,82.4h-.4v9.816h6.432v-.974H379.9V87.729h4.1v-.974h-4.1V83.374h5.458V82.4h-6.027Z" transform="translate(-253.976 -80.896)"/><path class="a" d="M453.126,82.4h-.4v2.321a6.015,6.015,0,0,1-.032.634.638.638,0,0,1-.118.337l-1.672,2.26a1.321,1.321,0,0,1-.38.358.738.738,0,0,1-.38.093h-.433a.931.931,0,0,1-.394-.093.863.863,0,0,1-.337-.322l-1.629-2.27a.792.792,0,0,1-.125-.358,5.522,5.522,0,0,1-.032-.616V82.4H446.2v2.321a5,5,0,0,0,.036.741,1.573,1.573,0,0,0,.294.784l1.615,2.245a2.249,2.249,0,0,0,.688.652,1.683,1.683,0,0,0,.623.2v2.865h.97V89.347a1.651,1.651,0,0,0,.587-.2,2.278,2.278,0,0,0,.688-.648l1.665-2.249a1.49,1.49,0,0,0,.3-.8c.018-.229.029-.473.029-.716V82.4h-.573Z" transform="translate(-297.157 -80.896)"/><path class="a" d="M500.317,82.576a6.341,6.341,0,0,0-5.855,0,2.467,2.467,0,0,0-.834,1.927V89.43a2.467,2.467,0,0,0,.834,1.927,4.4,4.4,0,0,0,2.922.716,4.523,4.523,0,0,0,2.933-.716,2.449,2.449,0,0,0,.856-1.927V84.506A2.453,2.453,0,0,0,500.317,82.576Zm-2.933,8.534a3.543,3.543,0,0,1-2.256-.476,1.5,1.5,0,0,1-.526-1.2V84.506a1.493,1.493,0,0,1,.526-1.2,3.535,3.535,0,0,1,2.256-.476,3.614,3.614,0,0,1,2.274.48,1.472,1.472,0,0,1,.548,1.2V89.43a1.472,1.472,0,0,1-.541,1.2A3.558,3.558,0,0,1,497.384,91.11Z" transform="translate(-327.6 -80.549)"/><path class="a" d="M549.214,82.4h-.4v7.377a1.5,1.5,0,0,1-.53,1.2,5.537,5.537,0,0,1-4.5,0,1.522,1.522,0,0,1-.53-1.207V82.4h-.974v7.377a2.485,2.485,0,0,0,.827,1.927,4.358,4.358,0,0,0,2.911.716,4.489,4.489,0,0,0,2.922-.716,2.471,2.471,0,0,0,.838-1.927V82.4H549.2Z" transform="translate(-358.828 -80.896)"/><path class="a" d="M597.354,87.476a1.368,1.368,0,0,0,.107-.218,3.665,3.665,0,0,0,.233-1.411V84.693a2.406,2.406,0,0,0-.566-1.622,2.188,2.188,0,0,0-1.74-.68H591.18v9.816h.974V88.335h4.333a1.662,1.662,0,0,1,1.128.3,1.182,1.182,0,0,1,.319.927v2.639h.974V89.567a1.952,1.952,0,0,0-1.54-2.091Zm-5.2-4.111h3.223a1.268,1.268,0,0,1,1.006.358,1.432,1.432,0,0,1,.326.985v1.157a2.069,2.069,0,0,1-.279,1.185c-.19.272-.677.329-1.053.329h-3.223Z" transform="translate(-390.219 -80.887)"/><path class="a" d="M672.288,82.4h-.283a1.038,1.038,0,0,0-.426.093.931.931,0,0,0-.4.387l-2.027,3.087a4.137,4.137,0,0,1-.358.5h0a.68.68,0,0,1-.15,0,.394.394,0,0,1-.158-.021,4.109,4.109,0,0,1-.358-.5l-2.038-3.087a.9.9,0,0,0-.4-.358,1.049,1.049,0,0,0-.433-.093h-.283a.791.791,0,0,0-.63.265.963.963,0,0,0-.208.655v8.9h.974V83.373h.147l.021.036L667.3,86.5a5.289,5.289,0,0,0,.5.673,1.288,1.288,0,0,0,1.633,0,4.87,4.87,0,0,0,.5-.67l2.034-3.073a.35.35,0,0,1,.036-.05h.143v8.842h.974V83.33a.988.988,0,0,0-.208-.659.82.82,0,0,0-.637-.272Z" transform="translate(-437.042 -80.895)"/><path class="a" d="M716.575,82.4h-.4v.974h2.586v7.868H716.17v.974h6.113v-.974h-2.553V83.374h2.553V82.4h-5.708Z" transform="translate(-470.449 -80.896)"/><path class="a" d="M766.8,82.4h-.4v6.381l-5.436-6.113h0a1.175,1.175,0,0,0-.193-.168.613.613,0,0,0-.34-.1.626.626,0,0,0-.376.132.566.566,0,0,0-.226.473v9.228h.974V83.947l5.615,6.3v1.97h.974V82.4h-.573Z" transform="translate(-498.473 -80.896)"/><path class="a" d="M816.409,84.134a1.992,1.992,0,0,0-.48-.913,2.345,2.345,0,0,0-.974-.591,4.588,4.588,0,0,0-1.508-.2H809v9.816h4.44a4.849,4.849,0,0,0,1.511-.2,2.338,2.338,0,0,0,.985-.58,1.94,1.94,0,0,0,.476-.91,4.784,4.784,0,0,0,.1-.988v-4.43A4.327,4.327,0,0,0,816.409,84.134Zm-2.962,7.123h-3.466V83.378h3.466a3.677,3.677,0,0,1,1.146.143,1.479,1.479,0,0,1,.594.358,1.125,1.125,0,0,1,.258.5,2.969,2.969,0,0,1,.09.752v4.419a3.316,3.316,0,0,1-.082.752,1.006,1.006,0,0,1-.254.48,1.472,1.472,0,0,1-.594.329A3.939,3.939,0,0,1,813.448,91.257Z" transform="translate(-530.036 -80.911)"/></svg>
        </div>
    </div>
</div>
@endsection