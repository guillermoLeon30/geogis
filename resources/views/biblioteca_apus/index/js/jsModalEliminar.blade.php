<script type="text/javascript">
	
function eliminar(id) {
	$('#idEliminar').val(id);
	$('#modalEliminar').modal('show');
}

$('#formEliminar').submit(function (e) {
	e.preventDefault();
	var id = $('#idEliminar').val();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('biblioteca_apus') }}/' + id,
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#btnEliminar').prop('disabled', true);
		 	$('#btnEliminar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEliminar .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#btnEliminar').prop('disabled', false);
		 	$('#btnEliminar').html('Eliminar');
		 	$('#modalEliminar .cerrar').attr('data-dismiss','modal');
		 	$('#modalEliminar').modal('hide');

		 	generarTabla(page, filtro);
		 	mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#btnEliminar').prop('disabled', false);
		 	$('#btnEliminar').html('Eliminar');
		 	$('#modalEliminar .cerrar').attr('data-dismiss','modal');
			$('#modalEliminar').modal('hide');
		 	mensaje('error', data, '#mensaje');
		}
	});
});

</script>