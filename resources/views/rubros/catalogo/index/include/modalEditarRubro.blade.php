<div class="modal fade" id="modalEditarRubro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Editar Rubro</h4>

      </div>

        <form id="formEditarRubro" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeEditarRubro"></div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Año</label>
              <div class="col-sm-9">
                <input type="hidden" id="id" name="id">
                <input class="form-control" type="text" id="anio" name="anio">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Rubro</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="rubro" name="rubro">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Unidad</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" id="unidad" name="unidad">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Valor Unitario</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input class="form-control" type="text" id="valor" name="valor">
                </div>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEditarRubro" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>