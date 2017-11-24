<div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Categoria</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach($categorias as $categoria)
              <tr>
                <td class="textarea">
                  <textarea disabled>{{ $categoria->nombre }}</textarea>
                </td>
                <td>${{ $categoria->total() }}</td>
                <td>
                  @if(Auth::user()->can('update', $categoria->proyecto))
                    <button class="btn btn-success" onclick="moverArriba({{$categoria->id}})">
                      <span class="glyphicon glyphicon-arrow-up"></span>
                    </button>

                    <button class="btn btn-success" onclick="moverAbajo({{$categoria->id}})">
                      <span class="glyphicon glyphicon-arrow-down"></span>
                    </button>
                  @endif

                  <a class="btn btn-primary" href="{{ url('categoria/'.$categoria->id.'/edit') }}">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </a>

                  @if(Auth::user()->can('editar', $categoria->proyecto))
                    <button class="btn btn-danger" onclick="eliminarCategoria({{$categoria->id}})">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div id="pagCategorias" class="box-footer">
        {{ $categorias->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
      </div>