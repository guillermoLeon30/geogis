<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">
      
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Cantidad</th>
              <th>Costo/Hr</th>
              <th>Rendimiento</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody id="tablaEquipos">
            @foreach($apu->equipos as $equipo)
              <tr id="filaEquipo{{ $equipo->id }}">
                <td class="textarea">
                  <input type="hidden" name="id" class="equipos" value="{{$equipo->id}}">
                  <input type="hidden" name="id" class="equipo{{ $equipo->id }}" value="{{$equipo->id}}">
                  <input type="hidden" name="cantidad" class="equipo{{ $equipo->id }}" value="{{$equipo->pivot->cantidad}}">
                  <input type="hidden" name="rendimiento" class="equipo{{ $equipo->id }}" value="{{$equipo->pivot->rendimiento}}">
                  <input type="hidden" name="costo" class="equipo{{ $equipo->id }}" value="{{$equipo->costo_hora}}">
                  <textarea disabled>{{ $equipo->descripcion }}</textarea>
                </td>
                <td>{{ $equipo->pivot->cantidad }}</td>
                <td>${{ $equipo->costo_hora }}</td>
                <td>{{ $equipo->pivot->rendimiento }}</td>
                <td>
                  ${{ round($equipo->pivot->cantidad*$equipo->costo_hora*$equipo->pivot->rendimiento ,2) }}
                </td>
                
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>

</div>