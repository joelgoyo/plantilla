<a class="a" onclick="tarjeta({{$data}},'{{ route('genealogy_type_id', [base64_encode($data->id)]) }}', '{{ asset('img/logo/blackbox.png')}}')">
    <div class="media">
        {{--@if (empty($data->photoDB))
            <img src="{{ asset('assets/img/pandora-logo.png') }}" height="48" width="48"
                class="rounded-circle align-self-center mr-1 di" alt="{{ $data->firstname }}" title="{{ $data->firstname }}">
        @else--}}
            <img src="{{ asset('img/logo/blackbox.png') }}" height="48" width="48" class="rounded-circle align-self-center mr-1 di"
                alt="{{ $data->name }}" title="{{ $data->name }}">
        {{--@endif--}}
        <div class="media-body">
            <h5 class="mt-1"> <b>{{ $data->name }}</b></h5>
        </div>
    </div>
</a>
