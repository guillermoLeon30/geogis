<div class="row">
  <div class="col-xs-12">
    <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title"></h3>

        @can('editar', $apu->categoria->proyecto)
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalIngresarManoDeObra">
            <i class="glyphicon glyphicon-plus"></i>
          </button>
        @endcan
      </div>

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Cantidad</th>
              <th>Costo/Hora</th>
              <th>Rendimiento</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>

          <tbody id="tablaManos">
            @foreach($apu->manoDeObra as $mano)
              <tr id="filaMano{{ $mano->id }}">
                <td class="textarea">
                  <input type="hidden" name="id" class="manos" value="{{$mano->id}}">
                  <input type="hidden" name="id" class="mano{{ $mano->id }}" value="{{$mano->id}}">
                  <textarea disabled>{{ $mano->descripcion }}</textarea>
                </td>
                <td>
                  <input type="text" name="cantidad" class="mano{{ $mano->id }}" value="{{$mano->pivot->cantidad}}" onblur="cambioMano({{$mano->id}})">
                </td>
                <td>
                  <input type="text" name="costo" class="mano{{ $mano->id }}" value="{{$mano->pivot->costo_hora2}}" onblur="cambioMano({{$mano->id}})">
                </td>
                <td>
                  <input type="text" name="rendimiento" class="mano{{ $mano->id }}" value="{{$mano->pivot->rendimiento}}" onblur="cambioMano({{$mano->id}})">
                </td>
                <td id="totalMano{{ $mano->id }}">
                  ${{ round($mano->pivot->costo_hora2 * $mano->pivot->cantidad * $mano->pivot->rendimiento,2) }}
                </td>
                @can('editar', $apu->categoria->proyecto)
                  <td>
                    <button class="btn btn-danger" onclick="quitarMano({{ $mano->id }})">
                      <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                  </td>
                @endcan
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>

</div>