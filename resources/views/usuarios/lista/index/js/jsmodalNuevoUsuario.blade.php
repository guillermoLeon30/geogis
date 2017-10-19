<script type="text/javascript">

$('#selTipo').select2();

$('#formNuevoUsuario').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('usuarios') }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#modalNuevoUsuario .cerrar').removeAttr('data-dismiss');
			$('#btnIngresoUsuario').prop('disabled', true);
			$('#btnIngresoUsuario').html('<i class="fa fa-refresh fa-spin"></i>');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#modalNuevoUsuario .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoUsuario').prop('disabled', false);
			$('#btnIngresoUsuario').html('Guardar');
			$('#modalNuevoUsuario').modal('hide');			

			generarTabla(page, filtro);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#modalNuevoUsuario .cerrar').attr('data-dismiss','modal');
			$('#btnIngresoUsuario').prop('disabled', false);
			$('#btnIngresoUsuario').html('Guardar');
			mensaje('error', data, '#mensajeNuevoUsuario');
		}
	});
});

</script>