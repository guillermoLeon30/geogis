<div class="modal fade" id="modalIngresarManoDeObra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Mano de Obra</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              
          <div class="form-group">
            <label class="col-sm-3 control-label">Mano de Obra</label>
            <div class="col-sm-9">
              <select id="selectManoDeObra" class="form-control" style="width: 100%"></select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Cantidad</label>
            <div class="col-sm-9">
              <input id="cantidadMano" class="form-control" type="text">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Rendimiento</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input id="rendimientoMano" type="text" class="form-control">
                <span class="input-group-addon">%</span>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="AgregarMano()">Ingresar</button>
      </div>
    </div>
  </div>
</div>