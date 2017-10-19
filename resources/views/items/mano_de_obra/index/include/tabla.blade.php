<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Fuente</th>
				<th>Descripcion</th>
				<th>Costo Hora</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($ManoDeObras as $ManoDeObra)
				<tr>
					<td>{{ $ManoDeObra->fecha() }}</td>
					<td>{{ $ManoDeObra->fuente }}</td>
					<td>{{ $ManoDeObra->descripcion }}</td>
					<td>{{ $ManoDeObra->costo_hora }}</td>

					<td>
						@can('update', new App\Models\ManoDeObra())
							<button class="btn btn-primary" onclick="editar({{ $ManoDeObra->id }})">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						@endcan

						@can('delete', new App\Models\ManoDeObra())
							<button class="btn btn-danger" onclick="eliminar({{ $ManoDeObra->id }})">
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
	{{ $ManoDeObras->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>