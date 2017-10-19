<script type="text/javascript">
	
function eliminar(id) {
	$('#idEliminar').val(id);
	$('#modalEliminarRol').modal('show');
}

$('#modalEliminarRol').submit(function (e) {
	e.preventDefault();

	var id = $('#idEliminar').val();
	
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('roles') }}/' + id,
		type: 'DELETE',
		dataType: 'json',
		beforeSend: function () {
			$('#modalEliminarRol').modal('hide');
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
		},
		success: function (data) {
			var filtro = $('#buscar').val();
			
			$('.overlay').detach();
			generarTabla(page, filtro);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			mensaje('error', 'Ocurrio un problema con la conexión', '#mensaje');
		}
	});
});

</script>