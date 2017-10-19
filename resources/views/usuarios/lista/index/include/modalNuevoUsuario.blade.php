<div class="modal fade" id="modalNuevoUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Nuevo Usuario</h4>

      </div>

        <form id="formNuevoUsuario" class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeNuevoUsuario"></div>

            <div class="form-group">
              <label for="color" class="col-sm-2 control-label">Nombre</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="name">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="email">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-2 control-label">Contraseña</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" name="password">
              </div>
            </div>

            <div class="form-group">
              <label for="color" class="col-sm-2 control-label">Tipo</label>
              <div class="col-sm-10">
                <select id="selTipo" class="form-control" name="tipo[]" style="width: 100%" multiple>
                  @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Estado</label>
              <div class="col-sm-10">
                <select class="form-control" name="estado">
                  <option value="Activo">Activo</option>
                  <option value="Desactivado">Desactivado</option>
                </select>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngresoUsuario" type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
    </div>
  </div>
</div>