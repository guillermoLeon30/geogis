<script type="text/javascript">

function agregarPermiso() {

	if (esValidoAgregar()) {
		var nombre = $('#selectPermisos option:selected').html();
		var id = $('#selectPermisos').val();
		var descripcion = $('#permisoId'+id).val();
		var fila = '<tr id="permiso'+id+'">'+
				        '<td>'+
				        	'<input type="hidden" class="permiso_id" value="'+ id +'">'+
				        	nombre+
				        '</td>'+
				        '<td>'+descripcion+'</td>'+
				        '<td>'+
					        '<button class="btn btn-danger" onclick="quitarPermiso('+ id +')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
				        '</td>'+
				    '</tr>';

		$('#modalIngresarPermiso').modal('hide');
		$('#tabla').append(fila);
	}
}

function quitarPermiso(index) {
	$('#permiso'+index).remove();
}

function esValidoAgregar() {
	var id = $('#selectPermisos').val();
	var idPermiso = [];

	$('.permiso_id').each(function () {
		idPermiso.push($(this).val());
	});

	if ($.inArray(id, idPermiso) >= 0) {
		return false;
	}

	return true;
}
	
</script>