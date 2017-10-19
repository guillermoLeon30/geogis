<script type="text/javascript">

$('#selTipoEditar').select2();
	
function editar(id) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('usuarios') }}/' + id + '/edit',
		type: 'GET',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				'</div>');
		},
		success: function (data) {
			$('.overlay').detach();
			abrirModalEditar(data.usuario, data.roles);
		},
		error: function () {
			$('.overlay').detach();

			mensaje('error', 'Ocurrio un error con la conexión.', '#mensaje');
		}
	});
}

function abrirModalEditar(usuario, roles) {
	$('#modalEditarUsuario').modal('show');
	$('#estado').val(usuario.estado);
	$('#id').val(usuario.id);
	$('#nombre').val(usuario.name);
	$('#email').val(usuario.email);
	$('#selTipoEditar').val(roles).trigger('change');
}

$('#formEditarUsuario').submit(function (e) {
	e.preventDefault();
	var datos = $(this).serialize();
	var id = $('#id').val();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('usuarios') }}/' + id,
		type: 'PUT',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
		 	$('#btnEditarUsuario').prop('disabled', true);
		 	$('#btnEditarUsuario').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEditarUsuario .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

		 	$('#btnEditarUsuario').prop('disabled', false);
		 	$('#btnEditarUsuario').html('Guardar');
		 	$('#modalEditarUsuario .cerrar').attr('data-dismiss','modal');
		 	$('#modalEditarUsuario').modal('hide');

		 	generarTabla(page, filtro);
		 	mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
		 	$('#btnEditarUsuario').prop('disabled', false);
		 	$('#btnEditarUsuario').html('Ingresar');
		 	$('#modalEditarUsuario .cerrar').attr('data-dismiss','modal');

		 	mensaje('error', data, '#mensajeEditarUsuario');
		}
	});
});

</script>