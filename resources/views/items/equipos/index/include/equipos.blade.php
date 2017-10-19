<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Fuente</th>
				<th>Descripcion</th>
				<th>Costo/Hora</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($equipos as $equipo)
				<tr>
					<td>{{ $equipo->fecha() }}</td>
					<td>{{ $equipo->fuente }}</td>
					<td>
						<textarea class="form-control" rows="3" style="min-width: 80px">{{ $equipo->descripcion }}
						</textarea>
					</td>
					<td>{{ $equipo->costo_hora }}</td>

					<td>
						@can('update', new App\Models\Equipo())
							<button class="btn btn-primary" onclick="editar({{ $equipo->id }})">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						@endcan

						@can('delete', new App\Models\Equipo())
							<button class="btn btn-danger" onclick="eliminar({{ $equipo->id }})">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						@endcan
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="box-footer">
	{{ $equipos->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>