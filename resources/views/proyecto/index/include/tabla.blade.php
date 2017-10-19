<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Nombre</th>
				<th>Total</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($proyectos as $p)
				<tr>
					<td>{{ $p->fecha() }}</td>
					<td class="textarea">
						<textarea rows="3" class="textarea">{{ $p->nombre }}</textarea>
					</td>
					<td>$100</td>

					<td>
							<a href="#" class="btn btn-info">
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
							</a>	
						
							<a href="{{ url('proyecto/'.$p->id.'/edit') }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
							
							<button class="btn btn-danger" onclick="eliminar()">
								<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
							</button>
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

<div class="box-footer">
	{{ $proyectos->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}		
</div>