<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectEquipos').select2({
	
	ajax: {
		id: function (e) {
			return elemento.id;
		},
		url: '{{ url('biblioteca_apus') }}',
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
var equipos = [];
var equipo = {};
var datosEquipo = {};
var contEquipos = 0;

function AgregarEquipo() {
	if (esValidoAgregarEquipo()) {
		var costoHora = $('#equipoCostoHora').val();

		equipo.id = $('#selectEquipos').val();
		datosEquipo.cantidad = $('#cantidadEquipo').val();
		datosEquipo.rendimiento = $('#rendimientoEquipo').val();
		datosEquipo.costoHora = costoHora;
		equipo.datos = datosEquipo;
		equipos[contEquipos] = equipo;

		var descripcion = $('#equipoDescripcion').val();
		var total = datosEquipo.cantidad * costoHora * datosEquipo.rendimiento / 100;

		var fila = '<tr id="filaEquipo'+ contEquipos +'">'+
						'<td class="textarea">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ equipo.datos.cantidad +'</td>'+
						'<td>$'+ costoHora +'</td>'+
						'<td>'+ equipo.datos.rendimiento +'%</td>'+
						'<td>$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarEquipo('+contEquipos+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaEquipos').append(fila);
		contEquipos++;
		equipo = {};
		datosEquipo = {};
		costos();
	}
}

function quitarEquipo(index) {
	$('#filaEquipo' + index).remove();
	delete equipos[index];
	costos();
}

function esValidoAgregarEquipo() {
	var id = $('#selectEquipos').val();
	var cantidad = $('#cantidadEquipo').val();
	var rendimiento = Number($('#rendimientoEquipo').val());

	if (isNaN(cantidad) || cantidad<=0 || !Number.isInteger(rendimiento) || rendimiento>100 || rendimiento<=0) {
		return false;
	}

	if (isNaN(id)) {return false;}

	for (var i = 0; i < equipos.length; i++) {
		if (typeof(equipos[i]) !== "undefined" && equipos[i].id == id) {return false;}
	}

	return true;
}

</script>
