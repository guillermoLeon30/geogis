<script type="text/javascript">
	
function guardar() {

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('biblioteca_apus') }}/{{ $apu->id }}?_method=PUT',
		type: 'POST',
		data: {
			datos:datos(),
			equipos:equipos(),
			materiales:materiales(),
			manosObra:manos(),
			transportes:transportes(),
		},
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
			$('#btnGuardar').prop('disabled', true);
			$('#btnGuardar').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			$('.overlay').detach();
			$('#btnGuardar').prop('disabled', false);
			$('#btnGuardar').html('<i class="fa fa-save"></i>');
			mensaje2('ok', data.mensaje, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			$('#btnGuardar').prop('disabled', false);
			$('#btnGuardar').html('<i class="fa fa-save"></i>');
			mensaje('error', data, '#mensaje');
		}
	});
}

function datos() {
	var datos = {};
	
	datos.descripcion = $('#descripcion').val();
	datos.unidad = $('#unidad').val();
	datos.por_indirectos = $('#porIndirecto').val();

	return datos;
}

</script>