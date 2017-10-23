<script type="text/javascript">
	
function eliminarCategoria(id) {
	$('#idEliminarCategoria').val(id);
	$('#modalEliminarCategoria').modal('show');
}

$('#formEliminarCategoria').submit(function (e) {
	e.preventDefault();
	var id = $('#idEliminarCategoria').val();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('categoria') }}/' + id,
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#btnEliminarCategoria').prop('disabled', true);
		 	$('#btnEliminarCategoria').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEliminarCategoria .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscarCategoria').val();

			$('#btnEliminarCategoria').prop('disabled', false);
		 	$('#btnEliminarCategoria').html('Eliminar');
		 	$('#modalEliminarCategoria .cerrar').attr('data-dismiss','modal');
		 	$('#modalEliminarCategoria').modal('hide');
		 	$('#total').val('$' + data.total);

		 	generarTablaCategoria(pageCategoria, filtro);
		 	//mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#btnEliminarCategoria').prop('disabled', false);
		 	$('#btnEliminarCategoria').html('Eliminar');
		 	$('#modalEliminarCategoria .cerrar').attr('data-dismiss','modal');
			$('#modalEliminarCategoria').modal('hide');
		 	mensaje('error', data, '#mensaje');
		}
	});
});

</script>