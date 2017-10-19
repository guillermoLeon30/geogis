<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Fuente</th>
				<th>Descripcion</th>
				<th>Unidad</th>
				<th>Costo por Km</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($transportes as $transporte)
				<tr>
					<td>{{ $transporte->fecha() }}</td>
					<td>{{ $transporte->fuente }}</td>
					<td>{{ $transporte->descripcion }}</td>
					<td>{{ $transporte->unidad }}</td>
					<td>{{ $transporte->costo_km }}</td>

					<td>
						@can('update', new App\Models\Transporte())
							<button class="btn btn-primary" onclick="editar({{ $transporte->id }})">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						@endcan

						@can('delete', new App\Models\Transporte())
							<button class="btn btn-danger" onclick="eliminar({{ $transporte->id }})">
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
	{{ $transportes->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>