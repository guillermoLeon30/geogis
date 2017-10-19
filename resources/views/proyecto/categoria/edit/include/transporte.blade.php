<div class="row">
  <div class="col-xs-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title"></h3>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalIngresarTransporte">
          <i class="glyphicon glyphicon-plus"></i>
        </button>
      </div>

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Unidad</th>
              <th>Tarifa</th>
              <th>Distancia</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>

          <tbody id="tablaTransporte">
            @foreach($apu->transportes as $transporte)
              <tr id="filaTransporte{{ $transporte->id }}">
                <td class="textarea">
                  <input type="hidden" name="id" class="transportes" value="{{$transporte->id}}">
                  <input type="hidden" name="id" class="transporte{{ $transporte->id }}" value="{{$transporte->id}}">
                  <input type="hidden" name="cantidad" class="transporte{{ $transporte->id }}" value="{{$transporte->pivot->cantidad}}">
                  <input type="hidden" name="costo" class="transporte{{ $transporte->id }}" value="{{$transporte->costo_km}}">
                  <textarea disabled>{{ $transporte->descripcion }}</textarea>
                </td>
                <td>{{ $transporte->unidad }}</td>
                <td>${{ $transporte->costo_km }}/km</td>
                <td>{{ $transporte->pivot->cantidad }}Km</td>
                <td>${{ round($transporte->costo_km*$transporte->pivot->cantidad, 2) }}</td>
                <td>
                  <button class="btn btn-danger" onclick="quitarTransporte({{ $transporte->id }})">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>

</div>