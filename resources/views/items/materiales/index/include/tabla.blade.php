<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Fuente</th>
				<th>Descripcion</th>
				<th>Unidad</th>
				<th>Costo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($materiales as $material)
				<tr>
					<td>{{ $material->fecha() }}</td>
					<td>{{ $material->fuente }}</td>
					<td>{{ $material->descripcion }}</td>
					<td>{{ $material->unidad }}</td>
					<td>{{ $material->costo }}</td>

					<td>
						@can('update', new App\Models\Material())
							<button class="btn btn-primary" onclick="editar({{ $material->id }})">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						@endcan

						@can('delete', new App\Models\Material())
							<button class="btn btn-danger" onclick="eliminar({{ $material->id }})">
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
	{{ $materiales->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>