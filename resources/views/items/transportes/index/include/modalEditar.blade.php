<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Editar</h4>

      </div>

        <form id="formEditar" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeEditar"></div>
            {{ method_field('PUT') }}

            <div class="form-group">
              <label class="col-sm-2 control-label">Fecha</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="fecha" class="form-control pull-right fecha" type="text" name="fecha">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Fuente</label>
              <div class="col-sm-10">
                <input id="id" type="hidden" name="id">
                <input id="fuente" class="form-control" type="text" name="fuente">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-10">
                <textarea id="descripcion" class="form-control" rows="3" name="descripcion"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Unidad</label>
              <div class="col-sm-10">
                <input id="id" type="hidden" name="id">
                <input id="unidad" class="form-control" type="text" name="unidad">
              </div>
            </div>            

            <div class="form-group">
              <label class="col-sm-2 control-label">Costo por Km</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input id="costo" class="form-control" type="text" name="costo_km">
                </div>
              </div>
            </div>
           

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEditar" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>