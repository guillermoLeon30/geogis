@php
  $subtotal = $apu->total();
  $indirectos = round($subtotal * $apu->por_indirectos / 100, 2);
  $utilidad = round($subtotal * $apu->por_utilidad / 100, 2);
  $total = $subtotal + $indirectos + $utilidad;
@endphp

<div class="box box-primary">
  <form class="form-horizontal">
    <div class="box-body">

      <div class="form-group">
        <label class="col-sm-2 control-label">Equipos</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="costoEquipos" type="text" class="form-control" value="{{ $apu->totalEquipo() }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Materiales</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="costoMateriales" type="text" class="form-control" value="{{ $apu->totalMateriales() }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Mano de Obra</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="costoManoObra" type="text" class="form-control" value="{{ $apu->totalManoDeObra() }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Transporte</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="totalTransporte" type="text" class="form-control" value="{{ $apu->totalTransportes() }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">SubTotal</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="totalCostos" type="text" class="form-control" value="{{ $subtotal }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Indirectos</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">%</span>
            <input id="porIndirecto" type="text" class="form-control" value="{{ $apu->por_indirectos }}" onblur="costoIndirectos()">
            <span class="input-group-addon">$</span>
            <input id="indirectos" type="text" class="form-control" value="{{ $indirectos }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Utilidad</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">%</span>
            <input id="porUtilidad" type="text" class="form-control" value="{{ $apu->por_utilidad }}" onblur="costoUtilidad()">
            <span class="input-group-addon">$</span>
            <input id="utilidad" type="text" class="form-control" value="{{ $utilidad }}" disabled>
          </div>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Total</label>
        <div class="col-sm-4">
          <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="total" type="text" class="form-control" value="{{ $total }}" disabled>
          </div>
        </div>            
      </div>
      
    </div>
  </form>
</div>