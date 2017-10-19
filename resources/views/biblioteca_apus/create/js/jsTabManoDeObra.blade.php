<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectManoDeObra').select2({
	
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
var manos = [];
var mano = {};
var datosMano = {};
var contManos = 0;

function AgregarMano() {
	if (esValidoAgregarMano()) {
		var costoHora = $('#manoCostoHora').val();

		mano.id = $('#selectManoDeObra').val();
		datosMano.cantidad = $('#cantidadMano').val();
		datosMano.costo = costoHora;
		datosMano.rendimiento = $('#rendimientoMano').val();
		mano.datos = datosMano;
		manos[contManos] = mano;

		var descripcion = $('#manoDescripcion').val();
		var total = datosMano.cantidad * costoHora * datosMano.rendimiento / 100;

		var fila = '<tr id="filaMano'+ contManos +'">'+
						'<td class="textarea">'+
							'<textarea disabled>'+ descripcion +'</textarea>'+
						'</td>'+
						'<td>'+ mano.datos.cantidad +'</td>'+
						'<td>$'+ costoHora +'</td>'+
						'<td>'+ mano.datos.rendimiento +'%</td>'+
						'<td>$'+ total.toFixed(2) +'</td>'+
						'<td>'+
							'<button class="btn btn-danger" onclick="quitarMano('+contManos+')">'+
								'<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>'+
							'</button>'+
						'</td>'+
					'</tr>';

		$('#tablaManos').append(fila);
		contManos++;
		mano = {};
		datosMano = {};
		costos();
	}
}

function quitarMano(index) {
	$('#filaMano' + index).remove();
	delete manos[index];
	costos();
}

function esValidoAgregarMano() {
	var id = $('#selectManoDeObra').val();
	var cantidad = $('#cantidadMano').val();
	var rendimiento = Number($('#rendimientoMano').val());

	if (isNaN(cantidad) || cantidad<=0 || !Number.isInteger(rendimiento) || rendimiento>100 || rendimiento<=0) {
		return false;
	}

	if (isNaN(id)) {return false;}

	for (var i = 0; i < manos.length; i++) {
		if (typeof(manos[i]) !== "undefined" && manos[i].id == id) {return false;}
	}

	return true;
}

</script>
