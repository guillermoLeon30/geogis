<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title"></h3>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalIngresarEquipos">
          <i class="glyphicon glyphicon-plus"></i>
        </button>
      </div>

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Cantidad</th>
              <th>Costo/Hr</th>
              <th>Rendimiento</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>

          <tbody id="tablaEquipos">
            @foreach($apu->equipos as $equipo)
              <tr id="filaEquipo{{ $equipo->id }}">
                <td class="textarea">
                  <input type="hidden" name="id" class="equipos" value="{{$equipo->id}}">
                  <input type="hidden" name="id" class="equipo{{ $equipo->id }}" value="{{$equipo->id}}">
                  <textarea disabled>{{ $equipo->descripcion }}</textarea>
                </td>
                <td>
                  <input type="text" name="cantidad" class="equipo{{ $equipo->id }}" value="{{$equipo->pivot->cantidad}}" onblur="cambioEquipo({{ $equipo->id }})">
                </td>
                <td>
                  <input type="text" name="costo" class="equipo{{ $equipo->id }}" value="{{$equipo->pivot->costo_hora2}}" onblur="cambioEquipo({{ $equipo->id }})">
                </td>
                <td>
                  <input type="text" name="rendimiento" class="equipo{{ $equipo->id }}" value="{{$equipo->pivot->rendimiento}}" onblur="cambioEquipo({{ $equipo->id }})">
                </td>
                <td id="totalEquipo{{$equipo->id}}">
                  ${{ round($equipo->pivot->cantidad*$equipo->pivot->costo_hora2*$equipo->pivot->rendimiento,2) }}
                </td>
                <td>
                  <button class="btn btn-danger" onclick="quitarEquipo({{ $equipo->id }})">
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