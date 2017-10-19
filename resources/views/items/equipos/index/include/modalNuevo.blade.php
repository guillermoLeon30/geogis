<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Nuevo Equipo</h4>

      </div>

        <form id="formNuevo" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeNuevo"></div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control pull-right fecha" type="text" name="fecha">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Fuente</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="fuente">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="descripcion"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Costo/Hora</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input class="form-control" type="text" name="costo_hora">
                </div>
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