<script type="text/javascript">

var cont = 0;
var idPermiso = [];

function agregarPermiso() {

	if (esValidoAgregar()) {
		var nombre = $('#selectPermisos option:selected').html();
		idPermiso[cont] = $('#selectPermisos').val();
		var descripcion = $('#permisoId'+idPermiso[cont]).val();
		var fila = '<tr id="fila'+cont+'">'+
				        '<td>'+nombre+'</td>'+
				        '<td>'+descripcion+'</td>'+
				        '<td>'+
					        '<button class="btn btn-danger" onclick="quitarPermiso('+cont+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
				        '</td>'+
				    '</tr>';

		$('#modalIngresarPermiso').modal('hide');
		$('#tabla').append(fila);
		cont++;
	}
}

function quitarPermiso(index) {
	delete idPermiso[index];
	$('#fila'+index).remove();
}

function esValidoAgregar() {
	var id = $('#selectPermisos').val();

	if ($.inArray(id, idPermiso) >= 0) {
		return false;
	}

	return true;
}
	
</script>