<!-- Modal -->
<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="modalInfoTitle">Detalles Retiro</h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <h5 class="">Billetera: <b id="modal-wallet "></b></h5>
                <h5 class="">Total a Recibir: <b>{{ number_format(Auth::user()->totalARetirar(),2) }}</b></h5>
                <div class="col-12 text-center">
                    <a href="#modalModalAprobar" class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal" >Continuar</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>