<div class="modal fade" id="modalIngresarCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Categoria</h4>

      </div>

        <form id="formCategoria" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeCategoria"></div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">
                <textarea class="form-control" rows="3" name="nombre"></textarea>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngresoCategoria" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>