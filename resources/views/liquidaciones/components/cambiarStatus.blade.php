<div class="modal fade" id="ModalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cambiar estatus</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('retiros.cambiarStatus') }}" method="POST">
        @csrf
        <div class="modal-body">

        <input type="hidden" name="id" value="{{$liquidacion->id}}">
        ¿Desea cambiar es estatus de la orden?
        <br>
        <label>Seleccione el estado</label>
        <select name="status" required class="form-control">
            <option value="">Seleccione un estado</option>
            <option value="0">Por Generar</option>
            <option value="1">Pendiente</option>
            <option value="2">Aprobado</option>
        </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </form>
        </div>
    </div>
</div>