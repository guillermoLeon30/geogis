<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalIngresarCategoria">
          <i class="glyphicon glyphicon-plus"></i>
        </button>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 200px;">
            <input id="buscarCategoria" type="text" class="form-control pull-right" placeholder="Buscar">

            <div class="input-group-btn">
              <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>

      <div id="tablaCategorias">
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
                  <td>$300</td>
                  <td>
                    <a class="btn btn-primary" href="{{ url('categoria/'.$categoria->id.'/edit') }}">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    
                    <button class="btn btn-danger">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div id="pagCategorias" class="box-footer">
          {{ $categorias->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
        </div>  
      </div>

    </div>

  </div>

</div>