<div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Editar Usuario</h4>

      </div>

        <form id="formEditarUsuario" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeEditarUsuario"></div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Estado</label>
              <div class="col-sm-10">
                <select id="estado" class="form-control" name="estado">
                  <option value="Activo">Activo</option>
                  <option value="Desactivado">Desactivado</option>
                </select>
              </div>
            </div>

           <div class="form-group">
              <label class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <input id="id" type="hidden" name="id">
                <select id="selTipoEditar" class="form-control" name="tipo[]" style="width: 100%" multiple>
                  @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnEditarUsuario" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>