{{--@if (strtolower($type) == 'matriz')--}}
    @if ($cant < 2)
        <li class="va">
            <a href="javascript:;" class="rounded-circles"><img src="{{asset('img/logo/blackbox.png')}}" class="rounded-circles"  alt="add"></a>
        </li>
    @endif
{{--@endif--}}