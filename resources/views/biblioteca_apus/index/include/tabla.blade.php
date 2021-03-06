<div class="box-body table-responsive no-padding">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Descripcion</th>
				<th>Unidad</th>
				<th>Total</th>
				<th>Opciones</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach($apus as $apu)
				<tr>
					<td class="textarea">
						<textarea rows="3" class="textarea">{{ $apu->descripcion }}</textarea>
					</td>
					<td>{{ $apu->unidad }}</td>
					<td>${{ $apu->total() }}</td>

					<td>
						@can('updateOrShow', App\Models\BibliotecaApus::class)
							<a href="{{ url('biblioteca_apus/'.$apu->id.'/edit') }}" class="btn btn-primary">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
						@endcan
						
						@can('delete', App\Models\BibliotecaApus::class)
							<button class="btn btn-danger" onclick="eliminar({{ $apu->id }})">
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
	{{ $apus->links('vendor.pagination.custom',['maxPages'=>5, 'offset'=>2]) }}
</div>