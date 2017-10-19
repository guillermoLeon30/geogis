<script type="text/javascript">
	
$('#formIngresoRubro').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('rubros') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#modalIngresarRubro .cerrar').removeAttr('data-dismiss');
			$('#btnIngresoRubro').prop('disabled', true);
			$('#btnIngresoRubro').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#modalIngresarRubro .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoRubro').prop('disabled', false);
			$('#btnIngresoRubro').html('Guardar');
			$('#modalIngresarRubro').modal('hide');			

			generarTabla(page, filtro);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalIngresarRubro .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoRubro').prop('disabled', false);
			$('#btnIngresoRubro').html('Guardar');
			mensaje('error', data, '#mensajeIngresoRubro');
		}
	});
});

</script>