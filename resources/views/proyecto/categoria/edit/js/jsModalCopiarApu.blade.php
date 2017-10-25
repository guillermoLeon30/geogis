<script type="text/javascript">

//-------------------------------------SELECCION DE PRODUCTO------------------------
$('#selectCopiar').select2({
	
	ajax: {
		id: function (e) {
			return apu.id;
		},
		url: '{{ url('biblioteca_apus') }}',
		type: 'GET',
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
				filtro: params.term,
				todo: 'todo',
				page: params.page
			};
		},
		processResults: function (data, params) {
			params.page = params.page || 1;

			return {
				results: data.apus,
				pagination: {
		          more: (params.page * 20) < data.total_count
		        }
			};
		}
	},
	cache: true,
	templateResult: formatApu,
	templateSelection: formatRepoApu,
	dropdownParent: $('#modalCopiar')
});

function formatApu (apu) {

  if (!apu.id) { return apu.text; }
  var $apu = $(
    	'<span>'+
			'<table>'+
				'<tbody>'+
					'<tr>'+
						'<td><strong>Nombre: </strong> </td>'+
						'<td style="width: 100%">'+
							apu.descripcion+
						'</td>'+
					'</tr>'+

					'<tr>'+
						'<td><strong>Unidad: </strong> </td>'+
						'<td>'+apu.unidad+'</td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
		'</span>'
  );
  return $apu;
}

function formatRepoApu(apu) {
	if (!apu.id) { return apu.text; }
	var $apu = $(
	    	'<span>'+
				apu.descripcion +
				'<b> Unidad: </b>' + apu.unidad +
			'</span>'
	);

	return $apu;
}

$('#selectCopiar').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//---------------------------------COPIAR----------------------------------------------
$('#formCopiar').submit(function (e) {
	e.preventDefault();
	
	var apu = $('#selectCopiar').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('categoria/copia') }}/'+ apu + '/{{ $categoria->id }}' ,
		type: 'POST',
		dataType: 'json',
		beforeSend: function () {
			$('#btnCopiar').prop('disabled', true);
		 	$('#btnCopiar').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalCopiar .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#btnCopiar').prop('disabled', false);
		 	$('#btnCopiar').html('Copiar');
		 	$('#modalCopiar .cerrar').attr('data-dismiss','modal');
		 	$('#modalCopiar').modal('hide');

		 	generarTabla(page, filtro);
		 	//mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#btnCopiar').prop('disabled', false);
		 	$('#btnCopiar').html('Copiar');
		 	$('#modalCopiar .cerrar').attr('data-dismiss','modal');
		 	mensaje('error', data, '#mensajeCopia');
		}
	});
});

</script>