<div class="modal fade" id="modalIngresarRubro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Ingresar Rubro</h4>

      </div>

        <form id="formIngresoRubro" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeIngresoRubro"></div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Año</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="anio">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Rubro</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="rubro">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Unidad</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="unidad">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-3 control-label">Valor Unitario</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                  <input class="form-control" type="text" name="valor">
                </div>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngresoRubro" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>