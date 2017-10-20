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
                    
                    <button class="btn btn-danger">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="box-footer">
          {{ $apus->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
        </div>  