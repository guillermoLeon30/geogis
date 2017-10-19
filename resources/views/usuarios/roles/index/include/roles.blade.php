<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($roles as $rol)
				@if($rol->nombre != 'Administrador')
					<tr>
						<td>{{ $rol->nombre }}</td>
						<td>{{ $rol->desripicion }}</td>

						<td>
							@can('update', new App\Models\Rol)
								<a href="{{ url('roles/'.$rol->id.'/edit') }}" class="btn btn-primary">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
								</a>
							@endcan
							
							@can('delete', new App\Models\Rol)
								<button class="btn btn-danger" onclick="eliminar({{ $rol->id }})">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button>
							@endcan
						</td>
					</tr>
				@endif
			@endforeach
		</tbody>
	</table>
</div>

<div class="box-footer">
	{{ $roles->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>