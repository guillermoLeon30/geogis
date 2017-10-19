<script type="text/javascript">
	
function editar(id) {
	
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('rubros') }}/' + id,
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
		},
		success: function (data) {
			$('.overlay').detach();
			abrirModalEditar(data.rubro);
		},
		error: function (data) {
			$('.overlay').detach();

			mensaje('error', data, '#mensaje');
		}
	});
}

function abrirModalEditar(rubro) {
	$('#id').val(rubro.id);
	$('#anio').val(rubro.anio);
	$('#rubro').val(rubro.rubro);
	$('#unidad').val(rubro.unidad);
	$('#valor').val(rubro.valor);

	$('#modalEditarRubro').modal('show');
}

$('#formEditarRubro').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();
	var id = $('#id').val();
	
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('rubros') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#modalEditarRubro .cerrar').removeAttr('data-dismiss');
			$('#btnEditarRubro').prop('disabled', true);
			$('#btnEditarRubro').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#modalEditarRubro .cerrar').attr('data-dismiss','modal');
			$('#btnEditarRubro').prop('disabled', false);
			$('#btnEditarRubro').html('Guardar');
			$('#modalEditarRubro').modal('hide');			

			generarTabla(page, filtro);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalEditarRubro .cerrar').attr('data-dismiss','modal');
			$('#btnEditarRubro').prop('disabled', false);
			$('#btnEditarRubro').html('Guardar');
			mensaje('error', data, '#mensajeEditarRubro');
		}
	});
});

</script>