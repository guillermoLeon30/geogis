@foreach($rol->permisos as $permiso)
	<tr id="permiso{{ $permiso->id }}">
		<td>
			<input type="hidden" class="permiso_id" value="{{ $permiso->id }}">
			{{ $permiso->nombre }}
		</td>
		<td>{{ $permiso->descripcion }}</td>
		<td>
			<button class="btn btn-danger" onclick="quitarPermiso({{ $permiso->id }})">
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
			</button>
		</td>
	</tr>
@endforeach