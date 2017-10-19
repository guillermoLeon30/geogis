<div class="modal fade" id="modalEliminarRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Eliminar Rubro</h4>

      </div>

        <form id="formEliminarRol" class="form-horizontal">
          <div class="modal-body">
            <div class="col-xs-12" id="mensajeEliminarRol"></div>
            <input type="hidden" name="id" id="idEliminar">
            ¿Desea eliminar el registro?
          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEliminarRol" type="submit" class="btn btn-primary">Eliminar</button>
          </div>
        </form>
    </div>
  </div>
</div>