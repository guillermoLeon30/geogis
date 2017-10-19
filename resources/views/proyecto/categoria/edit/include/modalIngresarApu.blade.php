<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">APU</h4>

      </div>

        <form id="formNuevo" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeNuevo"></div>

            <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">

            <div class="form-group">
              <label class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="descripcion"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Unidad</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="unidad">
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngreso" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>