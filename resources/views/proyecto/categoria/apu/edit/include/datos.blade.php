<div class="box box-primary">
  <form class="form-horizontal">
    <div class="box-body">
      
      <div class="form-group">
        <label class="col-sm-2 control-label">Descripción</label>
        <div class="col-sm-10">
          <textarea id="descripcion" class="form-control" rows="3">{{ $apu->descripcion }}</textarea>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Unidad</label>
        <div class="col-sm-10">
          <input id="unidad" type="text" class="form-control" value="{{ $apu->unidad }}">
        </div>            
      </div>

    </div>
  </form>
</div>