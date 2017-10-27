<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevo">
          <i class="glyphicon glyphicon-plus"></i>
        </button>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCopiar">
          <i class="fa fa-copy"></i>
        </button>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 200px;">
            <input id="buscar" type="text" class="form-control pull-right" placeholder="Buscar">

            <div class="input-group-btn">
              <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>

      <div id="tabla">
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Unidad</th>
                <th>Costo</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach($apus as $apu)
                <tr>
                  <td class="textarea">
                    <textarea disabled>{{ $apu->descripcion }}</textarea>
                  </td>
                  <td>{{ $apu->unidad }}</td>
                  <td>${{ $apu->totalGeneral() }}</td>
                  <td>{{ $apu->cantidad }}</td>
                  <td>${{ $apu->totalApuCantidad() }}</td>
                  <td>
                    <a class="btn btn-primary" href="{{ url('apu') }}/{{ $apu->id }}/edit">
                      <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    @if(Auth::user()->can('editar', $apu->categoria->proyecto))
                      <button class="btn btn-danger" onclick="eliminar({{$apu->id}})">
                        <span class="glyphicon glyphicon-trash"></span>
                      </button>
                    @endif
                    <a class="btn btn-info" href="{{ url('apu/excel/'.$apu->id) }}">
                      <span class="fa fa-print"></span>
                    </a>
                    
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer">
          {{ $apus->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
        </div>  
      </div>

    </div>

  </div>

</div>