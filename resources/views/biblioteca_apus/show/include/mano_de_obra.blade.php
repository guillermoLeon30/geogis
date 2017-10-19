<div class="row">
  <div class="col-xs-12">
    <div class="box box-warning">
      
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
                  <input type="hidden" name="cantidad" class="mano{{ $mano->id }}" value="{{$mano->pivot->cantidad}}">
                  <input type="hidden" name="rendimiento" class="mano{{ $mano->id }}" value="{{$mano->pivot->rendimiento}}">
                  <input type="hidden" name="costo" class="mano{{ $mano->id }}" value="{{$mano->costo_hora}}">
                  <textarea disabled>{{ $mano->descripcion }}</textarea>
                </td>
                <td>{{ $mano->pivot->cantidad }}</td>
                <td>${{ $mano->costo_hora }}</td>
                <td>{{ $mano->pivot->rendimiento }}%</td>
                <td>${{ round($mano->costo_hora * $mano->pivot->cantidad * $mano->pivot->rendimiento / 100, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>

</div>