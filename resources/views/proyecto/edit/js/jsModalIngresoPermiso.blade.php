<script type="text/javascript">

//-------------------------------------SELECCION DE USUARIO------------------------
$('#selectUsuarios').select2({
	ajax: {
		id: function (e) {
			return elemento.id;
		},
		url: '{{ url('usuarios') }}',
		type: 'GET',
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
				filtro: params.term,
				tipo: 'todos',
				idProyecto: {{ $proyecto->id }},
				page: params.page
			};
		},
		processResults: function (data, params) {
			params.page = params.page || 1;

			return {
				results: data.usuarios,
				pagination: {
		          more: (params.page * 20) < data.total_count
		        }
			};
		}
	},
	cache: true,
	templateResult: formatUsuario,
	templateSelection: formatRepoUsuario,
	dropdownParent: $('#modalIngresarPermiso')
});

function formatUsuario (usuario) {

  if (!usuario.id) { return usuario.text; }
  var $usuario = $(
    	'<span>'+ usuario.name +'</span>'
  );
  return $usuario;
}

function formatRepoUsuario(usuario) {
	if (!usuario.id) { return usuario.text; }
	var $usuario = $(
	    	'<span>'+ usuario.name +'</span>'
	);
	return $usuario;
}

$('#selectUsuarios').on('select2:open', function (evt) {
  $('.select2-results__options').css('max-height', '400px');
});

//----------------------------------------INGRESO-----------------------------------------------

$('#formPermiso').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('proyecto') }}/{{ $proyecto->id }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#modalIngresarPermiso .cerrar').removeAttr('data-dismiss');
			$('#btnIngresoPermiso').prop('disabled', true);
			$('#btnIngresoPermiso').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscarPermiso').val();

			$('#modalIngresarPermiso .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoPermiso').prop('disabled', false);
			$('#btnIngresoPermiso').html('Guardar');
			$('#modalIngresarPermiso').modal('hide');			

			generarTablaPermisos(pagePermiso, filtro);
			//mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalIngresarPermiso .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoPermiso').prop('disabled', false);
			$('#btnIngresoPermiso').html('Guardar');
			mensaje('error', data, '#mensajePermiso');
		}
	});
});

</script>