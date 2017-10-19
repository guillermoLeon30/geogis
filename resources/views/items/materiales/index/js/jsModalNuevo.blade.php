<script type="text/javascript">

$('#formNuevo').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('materiales') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#modalNuevo .cerrar').removeAttr('data-dismiss');
			$('#btnIngreso').prop('disabled', true);
			$('#btnIngreso').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#modalNuevo .cerrar').attr('data-dismiss','modal');
			$('#btnIngreso').prop('disabled', false);
			$('#btnIngreso').html('Guardar');
			$('#modalNuevo').modal('hide');			

			generarTabla(page, filtro);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalNuevo .cerrar').attr('data-dismiss','modal');
			$('#btnIngreso').prop('disabled', false);
			$('#btnIngreso').html('Guardar');
			mensaje('error', data, '#mensajeNuevo');
		}
	});
});

</script>