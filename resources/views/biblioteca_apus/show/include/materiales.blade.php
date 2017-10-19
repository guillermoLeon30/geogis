<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Unidad</th>
              <th>Costo/Unidad</th>
              <th>Cantidad</th>
              <th>Total</th>
            </tr>
          </thead>

          <tbody id="tablaMateriales">
            @foreach($apu->materiales as $material)
              <tr id="filaMaterial{{$material->id}}">
                <td class="textarea">
                  <input type="hidden" name="id" class="materiales" value="{{$material->id}}">
                  <input type="hidden" name="id" class="material{{ $material->id }}" value="{{$material->id}}">
                  <input type="hidden" name="cantidad" class="material{{ $material->id }}" value="{{$material->pivot->cantidad}}">
                  <input type="hidden" name="costo" class="material{{ $material->id }}" value="{{$material->costo}}">
                  <textarea disabled>{{ $material->descripcion }}</textarea>
                </td>
                <td>{{ $material->unidad }}</td>
                <td>${{ $material->costo }}</td>
                <td>{{ $material->pivot->cantidad }}</td>
                <td>${{ round($material->costo * $material->pivot->cantidad, 2) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

  </div>

</div>