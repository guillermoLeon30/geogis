<div class="modal fade" id="modalIngresarMateriales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Materiales</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              
          <div class="form-group">
            <label class="col-sm-2 control-label">Materiales</label>
            <div class="col-sm-10">
              <select id="selectMateriales" class="form-control" style="width: 100%"></select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Cantidad</label>
            <div class="col-sm-10">
              <input id="cantidadMaterial" class="form-control" type="text">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="AgregarMaterial()">Ingresar</button>
      </div>
    </div>
  </div>
</div>