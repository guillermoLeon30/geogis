<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectMateriales').select2({
	
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
				fuente: 'materiales',
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
	dropdownParent: $('#modalIngresarMateriales')
});

function formatProducto (material) {

  if (!material.id) { return material.text; }
  var $material = $(
    	'<span>'+
			'<table>'+
				'<tbody>'+
					'<tr>'+
						'<td><strong>Descripción: </strong> </td>'+
						'<td style="width: 100%">'+
								material.descripcion+
						'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Costo: </strong> </td>'+
						'<td>'+material.unidad+'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Costo: </strong> </td>'+
						'<td>'+material.costo+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
		'</span>'
  );
  return $material;
}

function formatRepoProducto(material) {
	if (!material.id) { return material.text; }
	var $material = $(
	    	'<span>'+
	    		'<input id="materialDescripcion" type="hidden" value="'+material.descripcion+'">'+
	    		'<input id="materialUnidad" type="hidden" value="'+material.unidad+'">'+
	    		'<input id="materialCosto" type="hidden" value="'+material.costo+'">'+
				material.descripcion + ' <strong>Costo:</strong>' + material.costo + '/' + material.unidad +
			'</span>'
	);

	return $material;
}

$('#selectMateriales').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//--------------------------------------INGRESAR---------------------------------
var materiales = [];
var material = {};
var contMateriales = 0;

function AgregarMaterial() {
	if (esValidoAgregarMaterial()) {
		var costo = $('#materialCosto').val();

		material.id = $('#selectMateriales').val();
		material.cantidad = $('#cantidadMaterial').val();
		material.costo = costo;
		materiales[contMateriales] = material;

		var descripcion = $('#materialDescripcion').val();
		var unidad = $('#materialUnidad').val();
		var total = material.cantidad * costo;

		var fila = '<tr id="filaMaterial'+ contMateriales +'">'+
						'<td class="textarea">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ unidad +'</td>'+
						'<td>$'+ costo +'</td>'+
						'<td>'+ material.cantidad +'</td>'+
						'<td>$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarMaterial('+contMateriales+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaMateriales').append(fila);
		contMateriales++;
		material = {};
		costos();
	}
}

function quitarMaterial(index) {
	$('#filaMaterial' + index).remove();
	delete materiales[index];
	costos();
}

function esValidoAgregarMaterial() {
	var id = $('#selectMateriales').val();
	var cantidad = $('#cantidadMaterial').val();

	if (isNaN(cantidad) || cantidad<=0) {return false;}

	if (isNaN(id)) {return false;}

	for (var i = 0; i < materiales.length; i++) {
		if (typeof(materiales[i]) !== "undefined" && materiales[i].id == id) {return false;}
	}

	return true;
}

</script>
