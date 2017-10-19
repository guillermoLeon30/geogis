<div class="box box-primary">
  <form id="formDatos" class="form-horizontal">
    <div class="box-body">
      
      <div class="form-group">
        <label class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10">
          {{ method_field('PUT') }}
          <input type="hidden" name="info" value="datos">
          <textarea id="nombre" name="nombre" class="form-control" rows="3">{{ $categoria->nombre }}</textarea>
        </div>            
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Total</label>
        <div class="col-sm-10">
          <input id="total" type="text" class="form-control" disabled>
        </div>            
      </div>

      <button type="submit" class="btn btn-success">Guardar</button>
    </div>
  </form>
</div>