<script type="text/javascript">
	
$('#selectPermisos').select2({
	dropdownParent: $('#modalIngresarPermiso')
});

function editar() {
	var rol = {};
	var idRol = $('#idRol').val();
	var idPermiso = [];

	rol['nombre'] = $('#nombre').val();
	rol['desripicion'] = $('#descripcion').val();
	
	$('.permiso_id').each(function () {
			idPermiso.push($(this).val());
	});

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('roles') }}/' + idRol,
		type: 'PUT',
		data: {'rol':rol, 'idPermiso':idPermiso},
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
			$('#btnGuardar').html('<i class="fa fa-save"></i> Editar Rol');
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			$('#btnGuardar').prop('disabled', false);
			$('#btnGuardar').html('<i class="fa fa-save"></i> Editar Rol');
			mensaje('error', data, '#mensaje');
		}
	});
}

</script>