<div class="modal fade" id="modalIngresarPermiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Permiso</h4>

      </div>

        <form id="formPermiso" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajePermiso"></div>
            
            {{ method_field('PUT') }}
            <input type="hidden" name="info" value="permisos">

            <div class="form-group">
              <label class="col-sm-2 control-label">Usuario</label>
              <div class="col-sm-10">
                <select id="selectUsuarios" class="form-control" style="width: 100%" name="user_id">
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Permiso</label>
              <div class="col-sm-10">
                <select class="form-control" name="funcion">
                  <option value="ver">Ver</option>
                  <option value="editar">Editar</option>
                </select>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngresoPermiso" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>