<div class="modal fade" id="modalIngresarPermiso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Permisos</h4>

      </div>

        <form class="form-horizontal">
          <div class="modal-body">

            <div class="col-xs-12" id="mensajeIngresoRubro"></div>

            <div class="form-group">
              <label for="color" class="col-sm-2 control-label">Permiso</label>
              <div class="col-sm-9">
                <select id="selectPermisos" class="form-control" style="width: 100%">
                  @foreach($permisos as $permiso)
                    <option value="{{ $permiso->id }}">{{ $permiso->nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnIngresoPermiso" type="button" class="btn btn-primary" onclick="agregarPermiso()">
                Agregar
            </button>
          </div>
        </form>
    </div>
  </div>
</div>

