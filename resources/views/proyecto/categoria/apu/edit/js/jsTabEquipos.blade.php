<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectEquipos').select2({
	
	ajax: {
		id: function (e) {
			return elemento.id;
		},
		url: '{{ url('apu') }}',
		type: 'GET',
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
				filtro: params.term,
				fuente: 'equipos',
				page: params.page
			};
		},
		processResults: function (data, params) {
			params.page = params.page || 1;

			return {
				results: data.elementos,
				pagination: {
		          more: (params.page * 20) < data.total_count
		        }
			};
		}
	},
	cache: true,
	templateResult: formatProducto,
	templateSelection: formatRepoProducto,
	dropdownParent: $('#modalIngresarEquipos')
});

function formatProducto (equipo) {

  if (!equipo.id) { return equipo.text; }
  var $equipo = $(
    	'<span>'+
			'<table>'+
				'<tbody>'+
					'<tr>'+
						'<td><strong>Descripción: </strong> </td>'+
						'<td style="width: 100%">'+
								equipo.descripcion+
						'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Costo/Hora: </strong> </td>'+
						'<td>'+equipo.costo_hora+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
		'</span>'
  );
  return $equipo;
}

function formatRepoProducto(equipo) {
	if (!equipo.id) { return equipo.text; }
	var $equipo = $(
	    	'<span>'+
	    		'<input type="hidden" id="equipoDescripcion" value="'+equipo.descripcion+'">'+
				equipo.descripcion +
				'<input type="hidden" id="equipoCostoHora" value="'+equipo.costo_hora+'">'+
				'<b> Costo/Hora: </b>' + equipo.costo_hora +
			'</span>'
	);

	return $equipo;
}

$('#selectEquipos').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//--------------------------------------INGRESAR---------------------------------
function AgregarEquipo() {
	if (esValidoAgregarEquipo()) {
		var costoHora = $('#equipoCostoHora').val();
		var id = $('#selectEquipos').val();
		var cantidad = $('#cantidadEquipo').val();
		var rendimiento = $('#rendimientoEquipo').val();
		var descripcion = $('#equipoDescripcion').val();
		var total = cantidad * costoHora * rendimiento;

		var fila = '<tr id="filaEquipo'+ id +'">'+
						'<td class="textarea">'+
							'<input type="hidden" name="id" class="equipos" value="'+id+'">'+
							'<input type="hidden" name="id" class="equipo'+id+'" value="'+id+'">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ 
							'<input type="text" name="cantidad" class="equipo'+id+'" value="'+cantidad+'" onblur="cambioEquipo('+id+')">'+
						'</td>'+
						'<td>'+ 
							'<input type="text" name="costo" class="equipo'+id+'" value="'+costoHora+'" onblur="cambioEquipo('+id+')">'+
						'</td>'+
						'<td>'+ 
							'<input type="text" name="rendimiento" class="equipo'+id+'" value="'+rendimiento+'" onblur="cambioEquipo('+id+')">'+
						'</td>'+
						'<td id="totalEquipo'+id+'">$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarEquipo('+id+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaEquipos').append(fila);
		costos();
	}
}

function quitarEquipo(index) {
	$('#filaEquipo' + index).remove();
	costos();
}

function esValidoAgregarEquipo() {
	var id = $('#selectEquipos').val();
	var cantidad = $('#cantidadEquipo').val();
	var rendimiento = $('#rendimientoEquipo').val();

	if (isNaN(cantidad) || cantidad<=0 || isNaN(rendimiento) || rendimiento<0.01) {
		return false;
	}

	if (isNaN(id)) {return false;}

	var eqs = equipos();

	for (var i = 0; i < eqs.length; i++) {
		if (eqs[i].id == id) {return false;}
	}

	return true;
}

function cambioEquipo(id) {
	var cantidad = Number($('#filaEquipo' + id + ' input[name=cantidad]').val());
	if (isNaN(cantidad) || cantidad < 0.01) {
		cantidad=0.01;
		$('#filaEquipo' + id + ' input[name=cantidad]').val('0.01');
	}

	var costo = $('#filaEquipo' + id + ' input[name=costo]').val();
	if (isNaN(costo) || costo <0.01) {
		costo = 0.01;
		$('#filaEquipo' + id + ' input[name=costo]').val('0.01');
	}

	var rendimiento = $('#filaEquipo' + id + ' input[name=rendimiento]').val();
	if (isNaN(rendimiento) || rendimiento < 0.01) {
		rendimiento = 0.01;
		$('#filaEquipo' + id + ' input[name=rendimiento]').val('0.01');
	}

	var total = cantidad * costo * rendimiento;
	$('#totalEquipo'+id).html('$'+total.toFixed(2));
	costos();
}

function equipos() {
	var equipos = [];
	var equipo = {};
	
	$('.equipos').each(function (i, node) {
		$('.equipo'+node.value).each(function (i, node) {
			equipo[node.name] = node.value;
		});
		equipos.push(equipo);
		equipo = {};
	});
	
	return equipos;
}
</script>
