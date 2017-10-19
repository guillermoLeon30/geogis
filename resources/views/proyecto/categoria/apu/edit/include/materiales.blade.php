<div class="row">
  <div class="col-xs-12">
    <div class="box box-success">
      <div class="box-header">
        <h3 class="box-title"></h3>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalIngresarMateriales">
          <i class="glyphicon glyphicon-plus"></i>
        </button>
      </div>

      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Unidad</th>
              <th>Costo/Unidad</th>
              <th>Cantidad</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>

          <tbody id="tablaMateriales">
            @foreach($apu->materiales as $material)
              <tr id="filaMaterial{{$material->id}}">
                <td class="textarea">
                  <input type="hidden" name="id" class="materiales" value="{{$material->id}}">
                  <input type="hidden" name="id" class="material{{ $material->id }}" value="{{$material->id}}">
                  <textarea disabled>{{ $material->descripcion }}</textarea>
                </td>
                <td>{{ $material->unidad }}</td>
                <td>
                  <input type="text" name="costo" onblur="cambioMaterial({{$material->id}})" class="material{{ $material->id }}" value="{{$material->pivot->costo2}}">
                </td>
                <td>
                  <input type="text" name="cantidad" onblur="cambioMaterial({{$material->id}})" class="material{{ $material->id }}" value="{{$material->pivot->cantidad}}">
                </td>
                <td id="totalMaterial{{ $material->id }}">
                  ${{ round($material->pivot->costo2 * $material->pivot->cantidad, 2) }}
                </td>
                <td>
                  <button class="btn btn-danger" onclick="quitarMaterial({{ $material->id }})">
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