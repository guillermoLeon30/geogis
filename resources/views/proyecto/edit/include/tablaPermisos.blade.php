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