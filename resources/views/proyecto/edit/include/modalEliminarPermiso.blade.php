<div class="modal fade" id="modalEliminarPermiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Eliminar</h4>

      </div>

        <form id="formEliminarPermiso" class="form-horizontal">
          <div class="modal-body">
            <div class="col-xs-12" id="mensajeEliminarPermiso"></div>
            <input type="hidden" name="info" value="eliminarPermiso">
            {{ method_field('PUT') }}
            <input type="hidden" name="user_id" id="idEliminarPermiso">
            ¿Desea eliminar el registro?
          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEliminarPermiso" type="submit" class="btn btn-primary">Eliminar</button>
          </div>
        </form>
    </div>
  </div>
</div>