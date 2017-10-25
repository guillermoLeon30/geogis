<div class="modal fade" id="modalCopiar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close cerrar" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h4 class="modal-title">Copiar</h4>

      </div>

        <form id="formCopiar" class="form-horizontal">
          <div class="modal-body">
            <div class="col-xs-12" id="mensajeCopia"></div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Apu</label>
              <div class="col-sm-10">
                <select id="selectCopiar" class="form-control" style="width: 100%"></select>
              </div>
            </div>
          </div> 

          <div class="modal-footer">
            <button type="button" class="btn btn-default cerrar" data-dismiss="modal">Cerrar</button>
            <button id="btnCopiar" type="submit" class="btn btn-primary">Copiar</button>
          </div>
        </form>
    </div>
  </div>
</div>