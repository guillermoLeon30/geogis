<script type="text/javascript">
	
function eliminar(id) {
	$('#idEliminar').val(id);
	$('#modalEliminarUsuario').modal('show');
}

$('#formEliminarUsuario').submit(function (e) {
	e.preventDefault();
	var id = $('#idEliminar').val();
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('usuarios') }}/' + id,
		type: 'DELETE',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('#btnEliminarUsuario').prop('disabled', true);
		 	$('#btnEliminarUsuario').html('<i class="fa fa-refresh fa-spin"></i>');
		 	$('#modalEliminarUsuario .cerrar').removeAttr('data-dismiss');
		},
		success: function (data) {
			var filtro = $('#buscar').val();

			$('#btnEliminarUsuario').prop('disabled', false);
		 	$('#btnEliminarUsuario').html('Eliminar');
		 	$('#modalEliminarUsuario .cerrar').attr('data-dismiss','modal');
		 	$('#modalEliminarUsuario').modal('hide');

		 	generarTabla(page, filtro);
		 	mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('#btnEliminarUsuario').prop('disabled', false);
		 	$('#btnEliminarUsuario').html('Eliminar');
		 	$('#modalEliminarUsuario .cerrar').attr('data-dismiss','modal');
			$('#modalEliminarUsuario').modal('hide');
		 	mensaje('error', data, '#mensaje');
		}
	});
});

</script>