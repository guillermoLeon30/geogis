<div class="box box-primary">
  <form id="formDatos" class="form-horizontal">
    <div class="box-body">
      
      <div class="form-group">
        <label class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          {{ method_field('PUT') }}
          <input type="hidden" name="info" value="datos">
          <textarea id="descripcion" name="nombre" class="form-control" rows="3">{{ $proyecto->nombre }}</textarea>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Fecha</label>
        <div class="col-sm-10">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input name="fecha" class="form-control fecha" type="text" value="{{ $proyecto->fecha() }}">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Total</label>
        <div class="col-sm-10">
          <input id="total" type="text" class="form-control" disabled value="${{ $proyecto->total() }}">
        </div>            
      </div>
      
      @if(Auth::user()->can('update', $proyecto))
        <button type="submit" class="btn btn-success">Guardar</button>
      @endif
    </div>
  </form>
</div>