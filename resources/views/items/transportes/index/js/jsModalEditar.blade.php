<script type="text/javascript">
	
function editar(id) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('transportes') }}/' + id + '/edit',
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
		},
		success: function (data) {
			$('.overlay').detach();
			abrirModalEditar(data.transporte);
		},
		error: function () {
			$('.overlay').detach();
			mensaje('error', 'Ocurrio un error con la conexión.', '#mensaje');
		}
	});
}

function abrirModalEditar(transporte) {
	$('#id').val(transporte.id);
	$('#fecha').val(transporte.fecha);
	$('#fuente').val(transporte.fuente);
	$('#descripcion').val(transporte.descripcion);
	$('#unidad').val(transporte.unidad);
	$('#costo').val(transporte.costo_km);
	
	$('#modalEditar').modal('show');
}

$('#formEditar').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#id').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('transportes') }}/' + id,
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
		 	$('#btnEditar').prop('disabled', true);
		 	$('#btnEditar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditar .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

		 	$('#btnEditar').prop('disabled', false);
		 	$('#btnEditar').html('Guardar');
		 	$('#modalEditar .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditar').modal('hide');

		 	generarTabla(page, filtro);
		 	mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
		 	$('#btnEditar').prop('disabled', false);
		 	$('#btnEditar').html('Guardar');
		 	$('#modalEditar .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeEditar');
		}
	});
});

</script>