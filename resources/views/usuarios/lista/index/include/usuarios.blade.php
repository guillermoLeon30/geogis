<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Email</th>
				<th>Estado</th>
				<th>Tipo</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($usuarios as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->estado }}</td>
					<td>
						<select multiple="" class="form-control" style="width: 192px">
							@foreach($user->roles as $rol)
								<option>{{ $rol->nombre }}</option>
							@endforeach
		                </select>
					</td>

					<td>
						@can('update', new App\User())
							<button class="btn btn-primary" onclick="editar({{ $user->id }})">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
						@endcan
						
						@can('delete', new App\User())
							<button class="btn btn-danger" onclick="eliminar({{ $user->id }})">
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
	{{ $usuarios->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}					
</div>