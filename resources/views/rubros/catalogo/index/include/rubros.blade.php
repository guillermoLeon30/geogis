<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Año</th>
				<th>Rubro</th>
				<th>Unidad</th>
				<th>Valor Unitario</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($rubros as $rubro)
				<tr>
					<td>{{ $rubro->anio }}</td>
					<td>{{ $rubro->rubro }}</td>
					<td>{{ $rubro->unidad }}</td>
					<td>${{ $rubro->valor }}</td>

					<td>
						<button class="btn btn-primary" onclick="editar({{ $rubro->id }})">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						</button>
						
						<button class="btn btn-danger" onclick="eliminar({{ $rubro->id }})">
							<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="box-footer">
	{{ $rubros->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>