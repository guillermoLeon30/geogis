<div class="modal fade" id="modalIngresarTransporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Transporte</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              
          <div class="form-group">
            <label class="col-sm-3 control-label">Transporte</label>
            <div class="col-sm-9">
              <select id="selectTransporte" class="form-control" style="width: 100%"></select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label">Distancia</label>
            <div class="col-sm-9">
              <div class="input-group">
                <input id="cantidadTransporte" class="form-control" type="text">
                <span class="input-group-addon">Km</span>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="AgregarTransporte()">Ingresar</button>
      </div>
    </div>
  </div>
</div>