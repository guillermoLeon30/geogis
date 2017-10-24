<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectCopiar').select2({
	
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

</script>