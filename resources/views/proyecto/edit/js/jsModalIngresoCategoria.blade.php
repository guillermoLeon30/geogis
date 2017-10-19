<script type="text/javascript">

$('#formCategoria').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('categoria') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#modalIngresarCategoria .cerrar').removeAttr('data-dismiss');
			$('#btnIngresoCategoria').prop('disabled', true);
			$('#btnIngresoCategoria').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscarCategoria').val();

			$('#modalIngresarCategoria .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoCategoria').prop('disabled', false);
			$('#btnIngresoCategoria').html('Guardar');
			$('#modalIngresarCategoria').modal('hide');			

			generarTablaCategoria(pageCategoria, filtro);
			//mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalIngresarCategoria .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoCategoria').prop('disabled', false);
			$('#btnIngresoCategoria').html('Guardar');
			mensaje('error', data, '#mensajeCategoria');
		}
	});
});

</script>