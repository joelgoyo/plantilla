     <!-- Modal -->
     <div class="modal fade" id="Modal_reactivacion" tabindex="-1" aria-labelledby="reactivacionModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header ">
             <h5 class="modal-title " id="reactivacionModalLabel">Reactivar usuario</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
             <p>Se descontara de tus ganancias o se procedera a realizar una nueva orden</p>
           </div>
           <div class="modal-footer">
             {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button> --}}
             <form action="{{route('reactivacionSaldo')}}" method="POST">
               @csrf
               <button type="submit" class="btn btn-danger">Utilizar ganancias</button>
             </form>
             <form action="{{route('reactivacion')}}" method="POST">
               @csrf
               <button type="submit" class="btn btn-primary">Reactivar</button>
             </form>
           </div>
         </div>
       </div>
     </div>
     <!-- Reactivacion Card ends -->
     </div>