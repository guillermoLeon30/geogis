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
                    @can('editar', $apu->categoria->proyecto)
                      <button class="btn btn-success" onclick="moverArriba({{$apu->id}})">
                        <span class="glyphicon glyphicon-arrow-up"></span>
                      </button>

                      <button class="btn btn-success" onclick="moverAbajo({{$apu->id}})">
                        <span class="glyphicon glyphicon-arrow-down"></span>
                      </button>
                    @endcan

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