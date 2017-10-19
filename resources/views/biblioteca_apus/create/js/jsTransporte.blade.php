<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectTransporte').select2({
	
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
				fuente: 'transporte',
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
	dropdownParent: $('#modalIngresarTransporte')
});

function formatProducto (transporte) {

  if (!transporte.id) { return transporte.text; }
  var $transporte = $(
    	'<span>'+
			'<table>'+
				'<tbody>'+
					'<tr>'+
						'<td><strong>Descripción: </strong> </td>'+
						'<td style="width: 100%">'+
								transporte.descripcion+
						'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Unidad: </strong> </td>'+
						'<td>'+transporte.unidad+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Costo/km: </strong> </td>'+
						'<td>'+transporte.costo_km+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
		'</span>'
  );
  return $transporte;
}

function formatRepoProducto(transporte) {
	if (!transporte.id) { return transporte.text; }
	var $transporte = $(
	    	'<span>'+
				transporte.descripcion +
				'<input type="hidden" id="descripcionTransporte" value="'+transporte.descripcion+'">'+
				'<input type="hidden" id="unidadTransporte" value="'+transporte.unidad+'">'+
				'<input type="hidden" id="costoTransporte" value="'+transporte.costo_km+'">'+
				'<b> Unidad: </b>' + transporte.unidad +
				'<b> Costo/km: </b>' + transporte.costo_km +
			'</span>'
	);

	return $transporte;
}

$('#selectTransporte').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//--------------------------------------INGRESAR---------------------------------
var transportes = [];
var transporte = {};
var contTransporte = 0;

function AgregarTransporte() {
	if (esValidoAgregarTransporte()) {
		var costoKm = $('#costoTransporte').val();

		transporte.id = $('#selectTransporte').val();
		transporte.cantidad = $('#cantidadTransporte').val();
		transporte.costo = costoKm;
		transportes[contTransporte] = transporte;

		var descripcion = $('#descripcionTransporte').val();
		var unidad = $('#unidadTransporte').val();
		var total = transporte.cantidad * costoKm;

		var fila = '<tr id="filaTransporte'+ contTransporte +'">'+
						'<td class="textarea">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ unidad +'</td>'+
						'<td>$'+ costoKm +'/km</td>'+
						'<td>'+ transporte.cantidad +'Km</td>'+
						'<td>$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarTransporte('+contTransporte+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaTransporte').append(fila);
		contTransporte++;
		transporte = {};
		costos();
	}
}

function quitarTransporte(index) {
	$('#filaTransporte' + index).remove();
	delete transportes[index];
	costos();
}

function esValidoAgregarTransporte() {
	var id = $('#selectTransporte').val();
	var cantidad = $('#cantidadTransporte').val();

	if (isNaN(cantidad) || cantidad<=0) {
		return false;
	}

	if (isNaN(id)) {return false;}

	for (var i = 0; i < transportes.length; i++) {
		if (typeof(transportes[i]) !== "undefined" && transportes[i].id == id) {return false;}
	}

	return true;
}

</script>
