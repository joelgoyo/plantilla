@extends('layouts/contentLayoutMaster')

@section('title', 'Retiro de capital')

@section('content')
<div id="logs-list">
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h4>Retiro Capital</h4>
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table nowrap scroll-horizontal-vertical myTable table-striped w-100">
                            <thead class="">

                                <tr class="text-center">                                
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Capital</th>
                                    <th>Acción</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse($inversiones as $inversion)
                                <tr class="text-center">
                                    <td>{{$inversion->id}}</td>
                                    <td>{{$inversion->created_at->format('Y-m-d')}}</td>
                                    <td>Capital</td>
                                    <td>{{$inversion->capital}}</td>
                                    <td>
                                        {{--
                                        <button type="button" data-toggle="modal" class="btn btn-danger" data-target="#ModalRetirar{{$inversion->id}}">
                                            Retirar
                                        </button>
                                        --}}
                                        <button type="button" class="btn btn-danger retirar" inversion_id="{{$inversion->id}}" capital="{{$inversion->capital}}">
                                            Retirar
                                        </button>
                                    </td>
                                    {{--
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalRetirar{{$inversion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Retirar inversion</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('contract.remove')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">

                                                <input type="hidden" name="id" value="{{$inversion->id}}">
                                                
                                                <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Guardar</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    --}}
                                    </td>
                                </tr>
                                @empty 
                                <tr>
                                    <td colspan="5" class="text-center">Sin Datos</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

    <input type="hidden" id="inversion_id" name="inversion_id">
    <script>

        let btnsRetirar = document.querySelectorAll('.retirar');
        function getWalletValue(){
            var billetera = document.getElementById('wallet').value;
            
            console.log(billetera);

            return billetera;
        }
        
        
        btnsRetirar.forEach(function(btnRetirar) {
            if(btnRetirar != null){
                btnRetirar.addEventListener("click", function( event ) {
                    
                    let inversionId = event.target.attributes.inversion_id.value;
                    let capital = event.target.attributes.capital.value;
                    
                    console.log(capital)
                    //llamamos la alerta
                    Swal.fire({
                    title: '¿Estas seguro?',
                    input: 'number',
                    html: `<input id="wallet" type="text" class="form-control" onchange="getWalletValue()" placeholder="Billetera USDT TRC 20" ></input>` ,
                    inputAttributes: {
                        //autocapitalize: 'off',
                        max: capital,
                        placeholder: 'Monto'
                    },
                    text: "Se te debitará el 5% de tu retiro",
                    icon: 'warning',
                    showCancelButton: true,
                    inputValidator: (value) => { 

                        if (parseInt(value, 10) > parseInt(capital,10)) {
                        return 'El monto maximo que se puede retirar es de: '+capital
                        }
                        if(!value){
                            return 'Debe ingresar un monto';
                        }            
                        
                    },
                    confirmButtonColor: '#00bb2d',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Retirar',
                    preConfirm: (login) => {
                        let billeteratrc = document.getElementById('wallet').value;
                        let data= {'inversionId': inversionId, 'amount': login, 'wallet': billeteratrc ,};
                        console.log(data)
                        return fetch(`{{route("liquidaciones.generar")}}`, {
                        method: 'POST', // or 'PUT'
                        body: JSON.stringify(data), // data can be `string` or {object}!
                        headers:{
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        })   
                        .then(response => {
                            
                            if (!response.ok) {
                            throw new Error(response.statusText)
                            }
                            
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                            `Request failed: ${error}`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                    })
                    .then((result) => {
        
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Retirado',
                            text: "Se ha generado una liquidación, a la espera de ser aprobada.',",
                            icon: 'success',
                            confirmButtonColor: '#00bb2d',
                            confirmButtonText: 'Ok',
                        })
                        
                        location.reload(true);
                    }
                    })
                }, false)
            }
        });
    </script>
@endsection



{{-- CONFIGURACIÓN DE DATATABLE --}}
{{-- @include('panels.datatables-config') --}}