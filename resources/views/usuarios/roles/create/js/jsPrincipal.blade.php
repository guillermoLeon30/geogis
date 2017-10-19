<script type="text/javascript">

$('#selectPermisos').select2({
	dropdownParent: $('#modalIngresarPermiso')
});

function guardar() {
	var rol = {};
	
	rol['nombre'] = $('#nombre').val();
	rol['desripicion'] = $('#descripcion').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('roles') }}',
		type: 'POST',
		data: {'rol':rol, 'idPermiso':idPermiso.filter(quitarNull)},
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
			$('#btnGuardar').html('<i class="fa fa-save"></i> Guardar');
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			$('#btnGuardar').prop('disabled', false);
			$('#btnGuardar').html('<i class="fa fa-save"></i> Guardar');
			mensaje('error', data, '#mensaje');
		}
	});
}

function quitarNull(item) {
	return item != null;
}

</script>