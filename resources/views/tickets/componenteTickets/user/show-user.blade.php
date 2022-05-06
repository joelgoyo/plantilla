@extends('layouts/contentLayoutMaster')
@section('title', 'Editando ticket')

@section('content')

<div class="title mb-5">
    <p class="rosado">Soporte <br> Ticket</p>
</div>

<div class="row match-height">
    <div class="col-md-12 col-12">
        <div class="card">
            <!--Card Header--->
            <div class="card-header">
                <h4 class="text-white fw-bold">
                    Revisando Ticket
                </h4>
            </div>
            <!--Card Header End--->

            <div class="card-body">
                <form action="{{route('ticket.update-user', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <div class="col-sm-6 mb-1">
                            <!--SELECT-->
                            <span class=" text-bold-600">Categoria:</span>

                            @if ($ticket->categories == '0')
                            <input type="text" class="form-control text-white" value="Ayuda" disabled>
                            @elseif($ticket->categories == '1')
                            <input type="text" class="form-control text-white" value="Soporte técnico" disabled>
                            @elseif($ticket->categories == '2')
                            <input type="text" class="form-control text-white" value="Corrección de datos" disabled>
                            @elseif($ticket->categories == '3')
                            <input type="text" class="form-control text-white" value="Bonos" disabled>
                            @elseif($ticket->categories == '4')
                            <input type="text" class="form-control text-white" value="Inversión total" disabled>
                            @endif
                            <!--SELECT END-->
                        </div>

                        <div class="col-sm-6">
                            <!--INPUT DE PRIORIDADES-->
                            <label for="">Prioridad:</label>
                            @if ($ticket->priority == '0')
                            <input type="text" class="form-control text-white" value="Alta" disabled>
                            @elseif($ticket->priority == '1')
                            <input type="text" class="form-control text-white" value="Media" disabled>
                            @elseif($ticket->priority == '2')
                            <input type="text" class="form-control text-white" value="Baja" disabled>
                            @endif
                            <!--INPUT DE PRIORIDADES END-->
                        </div>

                        <div class="col-sm-12 mb-2">
                            <!--Asunto -->
                            <span class=" text-bold-600">Asunto:</span>
                            <div class="input-group input-group-lg">
                                <input type="text" class="form-control" value="{{$ticket->issue}}" disabled>
                            </div>
                            <!--Asunto end-->

                            <!--Chat-->
                            <span class="text-bold-600">Chat:</span>

                            <div class="card-body msg_card_body">
                                @foreach ( $message as $item )
                                @if ($item->type == 0)
                                <div class="title1 ml-2 d-flex justify-content-start">
                                    <span>{{ $item->getUser->email}}</span>
                                </div>
                                <div class="d-flex justify-content-start mb-4">
                                    <div class="msg_cotainer">
                                        <div class="img">
                                            @if($item->image !== NULL)
                                            <a href="{{asset('storage/'.$item->image)}}" target="_blank">
                                                <img class="rounded mb-1" src="{{asset('storage/'.$item->image)}}" width="100%" height="150">
                                            </a>
                                            @else
                                            <img class="rounded" src="{{asset('storage/'.$item->image)}}" width="150" height="150" style="display: none;">
                                            @endif
                                        </div>
                                        <span> {{ $item->message }}</span>

                                    </div>
                                </div>
                                @elseif ($item->type == 1)
                                <div class="title2 d-flex justify-content-end">
                                    <span>{{ $item->getAdmin->email}}</span>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        <div class="img">
                                            @if($item->image !== NULL)
                                            <a href="{{asset('storage/'.$item->image)}}" target="_blank">
                                                <img class="rounded mb-1" src="{{asset('storage/'.$item->image)}}" width="100%" height="150">
                                            </a>
                                            @else
                                            <img class="rounded" src="{{asset('storage/'.$item->image)}}" width="150" height="150" style="display: none;">
                                            @endif
                                        </div>
                                        <span class="mb-1"> {{ $item->message }}</span>

                                    </div>
                                </div>

                                <!--Chat End-->
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
            </div>
        </div>


        @endsection