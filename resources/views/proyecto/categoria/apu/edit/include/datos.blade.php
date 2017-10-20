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

      <div class="form-group">
        <label class="col-sm-2 control-label">Cantidad</label>
        <div class="col-sm-10">
          <input id="cantidadApu" type="text" class="form-control" value="{{ $apu->cantidad }}" onblur="calculoApu()">
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Total</label>
        <div class="col-sm-10">
          <input id="totalApu" type="text" class="form-control" disabled value="{{ $apu->totalApuCantidad() }}">
        </div>            
      </div>

    </div>
  </form>
</div>