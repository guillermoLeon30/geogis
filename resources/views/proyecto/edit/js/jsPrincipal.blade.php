<script type="text/javascript">
	var pageCategoria = 1;
	var pagePermiso = 1;
	
	$(document).on('click', '#pagCategorias .pagination a', function (e) {
		e.preventDefault();
		pageCategoria = $(this).attr('href').split('page=')[1];
		var filtro = $('#buscarCategoria').val();
		
		generarTablaCategoria(pageCategoria, filtro);
	});

	$(document).on('click', '#pagPermisos .pagination a', function (e) {
		e.preventDefault();
		pagePermiso = $(this).attr('href').split('page=')[1];
		var filtro = $('#buscarPermiso').val();
		
		generarTablaPermisos(pagePermiso, filtro);
	});

	function generarTablaCategoria(page, filtro) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{ url('proyecto') }}/{{ $proyecto->id }}/edit',
			type: 'GET',
			data: {
					'pageCategoria':page, 
					'categoria':filtro,
					'tabla':'categoria',
					},
			dataType: 'json',
			beforeSend: function () {
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#tablaCategorias').html(data);
				$('.overlay').detach();
			}
		});
	}

	function generarTablaPermisos(page, filtro) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{ url('proyecto') }}/{{ $proyecto->id }}/edit',
			type: 'GET',
			data: {
					'pagePermisos':page, 
					'usuario':filtro,
					'tabla':'permisos',
					},
			dataType: 'json',
			beforeSend: function () {
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#tablaPermisos').html(data);
				$('.overlay').detach();
			}
		});
	}

	$('#buscarCategoria').on('keyup', function () {
		var filtro = $('#buscarCategoria').val();

		generarTablaCategoria(1, filtro);
	});

	$('#buscarPermiso').on('keyup', function () {
		var filtro = $('#buscarPermiso').val();

		generarTablaPermisos(1, filtro);
	});	

</script>