<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalIngresarPermiso">
          <i class="glyphicon glyphicon-plus"></i>
        </button>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input id="buscarPermiso" type="text" class="form-control pull-right" placeholder="Buscar">

            <div class="input-group-btn">
              <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>

      <div id="tablaPermisos">
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Permiso</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    @if($usuario->pivot->ver == 1)
                      <td>ver</td>
                    @else
                      <td>editar</td>
                    @endif
                    
                    <td>
                      <button class="btn btn-danger" onclick="eliminarPermiso({{ $usuario->id }})">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div id="pagPermisos" class="box-footer">
          {{ $usuarios->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}    
        </div>
      </div>

      

    </div>

  </div>

</div>