<div class="modal fade" id="modalIngresarEquipos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Equipos</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              
          <div class="form-group">
            <label class="col-sm-2 control-label">Equipo</label>
            <div class="col-sm-10">
              <select id="selectEquipos" class="form-control" style="width: 100%"></select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Cantidad</label>
            <div class="col-sm-10">
              <input id="cantidadEquipo" class="form-control" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Rendimiento</label>
            <div class="col-sm-10">
              <input id="rendimientoEquipo" type="text" class="form-control">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="AgregarEquipo()">Ingresar</button>
      </div>
    </div>
  </div>
</div>