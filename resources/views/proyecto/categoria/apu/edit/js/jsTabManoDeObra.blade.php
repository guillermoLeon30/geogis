<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectManoDeObra').select2({
	
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
				fuente: 'mano_de_obra',
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
	dropdownParent: $('#modalIngresarManoDeObra')
});

function formatProducto (ManoDeObra) {

  if (!ManoDeObra.id) { return ManoDeObra.text; }
  var $ManoDeObra = $(
    	'<span>'+
			'<table>'+
				'<tbody>'+
					'<tr>'+
						'<td><strong>Descripción: </strong> </td>'+
						'<td style="width: 100%">'+
								ManoDeObra.descripcion+
						'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Costo/Hora: </strong> </td>'+
						'<td>'+ManoDeObra.costo_hora+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
		'</span>'
  );
  return $ManoDeObra;
}

function formatRepoProducto(ManoDeObra) {
	if (!ManoDeObra.id) { return ManoDeObra.text; }
	var $ManoDeObra = $(
	    	'<span>'+
	    		'<input id="manoDescripcion" type="hidden" value="'+ManoDeObra.descripcion+'">'+
	    		'<input id="manoCostoHora" type="hidden" value="'+ManoDeObra.costo_hora+'">'+
				ManoDeObra.descripcion +
				'<b> Costo/Hora: </b>' + ManoDeObra.costo_hora +
			'</span>'
	);

	return $ManoDeObra;
}

$('#selectManoDeObra').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//--------------------------------------INGRESAR---------------------------------
function AgregarMano() {
	if (esValidoAgregarMano()) {
		var costoHora = $('#manoCostoHora').val();

		var id = $('#selectManoDeObra').val();
		var cantidad = $('#cantidadMano').val();
		var rendimiento = $('#rendimientoMano').val();
		var descripcion = $('#manoDescripcion').val();
		var total = cantidad * costoHora * rendimiento;

		var fila = '<tr id="filaMano'+ id +'">'+
						'<td class="textarea">'+
							'<input type="hidden" name="id" class="manos" value="'+id+'">'+
			                '<input type="hidden" name="id" class="mano'+id+'" value="'+id+'">'+
			                '<input type="hidden" name="cantidad" class="mano'+id+'" value="'+cantidad+'">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ 
							'<input type="text" name="cantidad" class="mano'+id+'" value="'+cantidad+'">'+
						'</td>'+
						'<td>'+ 
							'<input type="text" name="costo" class="mano'+id+'" value="'+costoHora+'">'+
						'</td>'+
						'<td>'+ 
							'<input type="text" name="rendimiento" class="mano'+id+'" value="'+rendimiento+'">'+
						'</td>'+
						'<td id="totalMano'+id+'">$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarMano('+id+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaManos').append(fila);
		costos();
	}
}

function quitarMano(index) {
	$('#filaMano' + index).remove();
	costos();
}

function esValidoAgregarMano() {
	var id = $('#selectManoDeObra').val();
	var cantidad = $('#cantidadMano').val();
	var rendimiento = $('#rendimientoMano').val();

	if (isNaN(cantidad) || cantidad<=0 || isNaN(rendimiento) || rendimiento<0.01) {
		return false;
	}

	if (isNaN(id)) {return false;}

	var mns = manos();

	for (var i = 0; i < mns.length; i++) {
		if (mns[i].id == id) { return false; }
	}

	return true;
}

function cambioMano(id) {
	var cantidad = Number($('#filaMano' + id + ' input[name=cantidad]').val());
	if (isNaN(cantidad) || cantidad < 0.01) {
		cantidad=0.01;
		$('#filaMano' + id + ' input[name=cantidad]').val('0.01');
	}

	var costo = $('#filaMano' + id + ' input[name=costo]').val();
	if (isNaN(costo) || costo <0.01) {
		costo = 0.01;
		$('#filaMano' + id + ' input[name=costo]').val('0.01');
	}

	var rendimiento = $('#filaMano' + id + ' input[name=rendimiento]').val();
	if (isNaN(rendimiento) || rendimiento < 0.01) {
		rendimiento = 0.01;
		$('#filaMano' + id + ' input[name=rendimiento]').val('0.01');
	}

	var total = cantidad * costo * rendimiento;
	$('#totalMano'+id).html('$'+total.toFixed(2));
	costos();
}

function manos() {
	var manos = [];
	var mano = {};
	
	$('.manos').each(function (i, node) {
		$('.mano'+node.value).each(function (i, node) {
			mano[node.name] = node.value;
		});
		manos.push(mano);
		mano = {};
	});
	
	return manos;
}

</script>
