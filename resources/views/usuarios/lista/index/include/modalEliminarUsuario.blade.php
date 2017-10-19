<div class="modal fade" id="modalEliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Eliminar Rubro</h4>

      </div>

        <form id="formEliminarUsuario" class="form-horizontal">
          <div class="modal-body">
            <div class="col-xs-12" id="mensajeEliminarUsuario"></div>
            <input type="hidden" name="id" id="idEliminar">
            ¿Desea eliminar el registro?
          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEliminarUsuario" type="submit" class="btn btn-primary">Eliminar</button>
          </div>
        </form>
    </div>
  </div>
</div>