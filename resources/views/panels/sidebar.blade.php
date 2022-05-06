@php
$configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{(($configData['theme'] === 'dark') || ($configData['theme'] === 'semi-dark')) ? 'menu-dark' : 'menu-light'}} menu-accordion " data-scroll-to-active="true" style="background-color:#1d1b2f;">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item me-auto">
        <a class="navbar-brand" href="{{url('/')}}">
          <svg style="width: 100%;" xmlns="http://www.w3.org/2000/svg" width="284.397" height="27.014" viewBox="0 0 284.397 27.014">
            <defs>
              <style>
                .a {
                  fill: #ebaaff;
                }
              </style>
            </defs>
            <g transform="translate(-40.09 -37.56)">
              <path class="a" d="M40.09,38.62H55.028v3.343H43.861V50H54.643v3.365H43.861v8.2H55.384v3.358H40.09Z" transform="translate(0 -0.682)" />
              <path class="a" d="M140.712,38.62h4.548l-10.529,12.7L146,64.953h-4.555l-8.968-10.914-9.053,10.914H118.82L130.151,51.32l-10.522-12.7h4.6L132.5,48.675Z" transform="translate(-50.668 -0.682)" />
              <path class="a" d="M256.8,58.21v4.145a19.7,19.7,0,0,1-9.574,2.263,14.7,14.7,0,0,1-7.485-1.782,13.056,13.056,0,0,1-4.865-4.883,13.255,13.255,0,0,1-1.782-6.729,12.856,12.856,0,0,1,4.1-9.673A14.072,14.072,0,0,1,247.31,37.63a23.7,23.7,0,0,1,9.217,2.171v4.063a18.19,18.19,0,0,0-9.028-2.641,10.455,10.455,0,0,0-7.513,2.851,9.492,9.492,0,0,0-3,7.161,9.4,9.4,0,0,0,2.941,7.129,10.483,10.483,0,0,0,7.521,2.791A17.089,17.089,0,0,0,256.8,58.21Z" transform="translate(-124.211 -0.045)" />
              <path class="a" d="M345.12,38.62h14.927v3.343H348.891V50h10.8v3.365h-10.8v8.2H360.4v3.358H345.12Z" transform="translate(-196.309 -0.682)" />
              <path class="a" d="M431.77,38.62h3.771v22.9H447.4v3.429H431.77Z" transform="translate(-252.074 -0.682)" />
              <path class="a" d="M521.53,53.3l-2.851-1.743a13.031,13.031,0,0,1-3.835-3.24,6.138,6.138,0,0,1-1.141-3.664,6.476,6.476,0,0,1,2.16-5.054,8.017,8.017,0,0,1,5.607-1.943,10.628,10.628,0,0,1,6.059,1.853V43.79a8.751,8.751,0,0,0-6.127-2.741,5.069,5.069,0,0,0-3.037.855,2.591,2.591,0,0,0-1.187,2.188,3.375,3.375,0,0,0,.877,2.217,10.906,10.906,0,0,0,2.791,2.164l2.88,1.7q4.815,2.88,4.819,7.328a6.733,6.733,0,0,1-2.139,5.147,7.8,7.8,0,0,1-5.514,1.978,11.573,11.573,0,0,1-7.086-2.392V57.452q3.051,3.853,7.064,3.853a4.441,4.441,0,0,0,2.951-.987A3.087,3.087,0,0,0,525,57.848Q525,55.46,521.53,53.3Z" transform="translate(-304.802 -0.064)" />
              <path class="a" d="M599.58,38.62h3.771V64.953H599.58Z" transform="translate(-360.072 -0.682)" />
              <path class="a" d="M669.863,37.56a14.159,14.159,0,0,1,10.162,3.864,12.815,12.815,0,0,1,4.06,9.688,12.619,12.619,0,0,1-4.1,9.645,14.566,14.566,0,0,1-10.336,3.817,13.731,13.731,0,0,1-9.919-3.817,12.73,12.73,0,0,1-3.964-9.567,13.009,13.009,0,0,1,4-9.766A13.937,13.937,0,0,1,669.863,37.56Zm.15,3.564a10.217,10.217,0,0,0-7.428,2.826,9.667,9.667,0,0,0-2.912,7.239,9.449,9.449,0,0,0,2.919,7.086,10.832,10.832,0,0,0,14.663-.057A9.624,9.624,0,0,0,680.2,51.04,9.424,9.424,0,0,0,677.255,44a10.019,10.019,0,0,0-7.243-2.855Z" transform="translate(-396.235 0)" />
              <path class="a" d="M781,64.953V38.62h6.6a9.533,9.533,0,0,1,6.344,1.978,6.617,6.617,0,0,1,2.345,5.346,6.59,6.59,0,0,1-4.448,6.483,11.76,11.76,0,0,1,2.47,2.263,45.754,45.754,0,0,1,3.393,4.99q1.376,2.238,2.2,3.372l1.411,1.9h-4.487l-1.148-1.732c-.039-.064-.114-.171-.228-.324l-.713-1.037-1.169-1.921-1.262-2.057a20.289,20.289,0,0,0-2.139-2.581,8.12,8.12,0,0,0-1.754-1.383,5.892,5.892,0,0,0-2.634-.424h-.98V64.953Zm4.9-23.129h-1.13v8.312H786.2a10.653,10.653,0,0,0,3.921-.488,3.707,3.707,0,0,0,1.661-1.483,4.277,4.277,0,0,0,.627-2.249,4.021,4.021,0,0,0-.659-2.256,3.54,3.54,0,0,0-1.857-1.426,13.617,13.617,0,0,0-3.974-.41Z" transform="translate(-476.829 -0.682)" />
            </g>
          </svg>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
          <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
          <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" style="background-color:#1d1b2f;">
      {{-- Para Usuarios Normales --}}
      @if (Auth::user()->admin == 0)
      {{-- Foreach menu item starts --}}
      @if(isset($menuData[0]))
      @foreach($menuData[0]->menu as $menu)
      @if(isset($menu->navheader))
      <li class="navigation-header">
        <span>{{ __('locale.'.$menu->navheader) }}</span>
        <i data-feather="more-horizontal"></i>
      </li>
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      @endphp
      <li class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
        <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
          <i data-feather="{{ $menu->icon }}"></i>
          <span class="menu-title text-truncate">{{ __('locale.'.$menu->name) }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
          <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
        @include('panels/submenu', ['menu' => $menu->submenu])
        @endif
      </li>
      @endif
      @endforeach
      @endif
      {{-- Foreach menu item ends --}}

      {{-- para usuarios admin --}}
      @else

      {{-- Foreach menu item starts --}}
      @if(isset($menuData[1]))
      @foreach($menuData[1]->menu as $menu)
      @if(isset($menu->navheader))
      <li class="navigation-header">
        <span>{{ __('locale.'.$menu->navheader) }}</span>
        <i data-feather="more-horizontal"></i>
      </li>
      @else
      {{-- Add Custom Class with nav-item --}}
      @php
      $custom_classes = "";
      if(isset($menu->classlist)) {
      $custom_classes = $menu->classlist;
      }
      @endphp
      <li class="nav-item {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }} {{ $custom_classes }}">
        <a href="{{isset($menu->url)? url($menu->url):'javascript:void(0)'}}" class="d-flex align-items-center" target="{{isset($menu->newTab) ? '_blank':'_self'}}">
          <i data-feather="{{ $menu->icon }}"></i>
          <span class="menu-title text-truncate">{{ __('locale.'.$menu->name) }}</span>
          @if (isset($menu->badge))
          <?php $badgeClasses = "badge badge-pill badge-light-primary ml-auto mr-1" ?>
          <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }} ">{{$menu->badge}}</span>
          @endif
        </a>
        @if(isset($menu->submenu))
        @include('panels/submenu', ['menu' => $menu->submenu])

        @endif
      </li>


      @endif
      @endforeach

      @if (env('APP_ENV') == 'local' && Auth::user()->admin == 1)

      <div class="">
        <button class="btn-grad m-2 dropdown-item w-100 dropbtn" onclick="myFunction()" class="">
          <i class="fas fa-sign text-white" style="font-size: 17px;"></i>
          <span class="text-white fw-bold" style="margin-left: 13px;">Crones</span>
        </button>
        <div id="myDropdown" class="dropdown-content">
          <a href="{{route('bono.cartera')}}" class="text-white fw-bold">Cartera</a>
          <a href="{{route('bono.cronRentabilidad')}}" class="text-white fw-bold">Rentabilidad</a>
          <a href="{{route('start.cronSumRentabilidad')}}" class="text-white fw-bold">sumRentabilidad</a>
          <a href="{{route('start.payrentabilidad')}}" class="text-white fw-bold">PagaRentabilidad</a>
        </div>
      </div>
      @endif


      @endif
      {{-- Foreach menu item ends --}}
      @endif
      <form method="POST" class="mt-2" action="{{ route('logout') }}">
        @csrf
        <li class="">
          <button class="btn-grad m-2 dropdown-item w-100 " onclick="event.preventDefault();this.closest('form').submit();">
            <i class="fas fa-sign-out-alt text-white" style="font-size: 17px;"></i> <span class="text-white fw-bold" style="margin-left: 13px;">Cerrar sesion</span>
          </button>
        </li>
      </form>
    </ul>
  </div>
  <style>
    .btn-grad:hover,
    .dropbtn:hover,
    .dropbtn:focus {
      background-image: linear-gradient(to right, #7367F01F 0%, #EBAAFF 51%, #7367F01F 100%)
    }

    .btn-grad {
      padding: 13px;
      text-transform: uppercase;
      transition: 0.5s;
      background-size: 200% auto;
      border-radius: 10px;
      display: block;
    }

    .btn-grad:hover {
      background-position: right center;
      color: #7367F01F;
      text-decoration: none;
    }


    .dropbtn {
      background-color: transparent;
      color: white;
      border-radius: 10px;
      font-size: 16px;
      margin-left: 50px;
      font-weight: 500;
      border: none;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      background-color: transparent;
      min-width: 160px;
      margin-left: 50px;
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      color: white;
      display: block;
    }

    .dropdown-content a:hover {
      background-image: linear-gradient(to right, #7367F01F 0%, #EBAAFF 51%, #7367F01F 100%)
    }

    .show {
      display: block;
    }
  </style>
  <script>
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>
</div>
<!-- END: Main Menu-->