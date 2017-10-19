<script type="text/javascript">
	
function eliminar(id) {
	$('#idEliminar').val(id);
	$('#modalEliminarRubro').modal('show')
}

$('#modalEliminarRubro').submit(function (e) {
	e.preventDefault();
	
	var id = $('#idEliminar').val();
	
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('rubros') }}/' + id,
		type: 'DELETE',
		dataType: 'json',
		beforeSend: function () {
			$('#modalEliminarRubro .cerrar').removeAttr('data-dismiss');
			$('#btnEliminarRubro').prop('disabled', true);
			$('#btnEliminarRubro').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#modalEliminarRubro .cerrar').attr('data-dismiss','modal');
			$('#btnEliminarRubro').prop('disabled', false);
			$('#btnEliminarRubro').html('Eliminar');
			$('#modalEliminarRubro').modal('hide');			

			generarTabla(page, filtro);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalEliminarRubro .cerrar').attr('data-dismiss','modal');
			$('#btnEliminarRubro').prop('disabled', false);
			$('#btnEliminarRubro').html('Eliminar');
			mensaje('error', data, '#mensajeEditarRubro');
		}
	});
});

</script>