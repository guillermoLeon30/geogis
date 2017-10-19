<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectMateriales').select2({
	
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
				material.descripcion +
			'</span>'
	);

	return $material;
}

$('#selectMateriales').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//--------------------------------------INGRESAR---------------------------------
function AgregarMaterial() {
	if (esValidoAgregarMaterial()) {
		var costo = $('#materialCosto').val();
		var id = $('#selectMateriales').val();
		var cantidad = $('#cantidadMaterial').val();
		var descripcion = $('#materialDescripcion').val();
		var unidad = $('#materialUnidad').val();
		var total = cantidad * costo;

		var fila = '<tr id="filaMaterial'+ id +'">'+
						'<td class="textarea">'+
							'<input type="hidden" name="id" class="materiales" value="'+id+'">'+
                  			'<input type="hidden" name="id" class="material'+id+'" value="'+id+'">'+
                  			'<input type="hidden" name="cantidad" class="material'+id+'" value="'+cantidad+'">'+
                  			'<input type="hidden" name="costo" class="material'+id+'" value="'+costo+'">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ unidad +'</td>'+
						'<td>$'+ costo +'</td>'+
						'<td>'+ cantidad +'</td>'+
						'<td>$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarMaterial('+id+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaMateriales').append(fila);
		costos();
	}
}

function quitarMaterial(index) {
	$('#filaMaterial' + index).remove();
	costos();
}

function esValidoAgregarMaterial() {
	var id = $('#selectMateriales').val();
	var cantidad = $('#cantidadMaterial').val();

	if (isNaN(cantidad) || cantidad<=0) {return false;}

	if (isNaN(id)) {return false;}
	
	var mts = materiales();

	for (var i = 0; i < mts.length; i++) {
		if (mts[i].id == id) { return false; }
	}

	return true;
}

function materiales() {
	var materiales = [];
	var material = {};
	
	$('.materiales').each(function (i, node) {
		$('.material'+node.value).each(function (i, node) {
			material[node.name] = node.value;
		});
		materiales.push(material);
		material = {};
	});
	
	return materiales;
}

</script>
