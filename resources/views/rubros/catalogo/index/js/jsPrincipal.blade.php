<script type="text/javascript">
	var page = 1;

	$(document).on('click', '.pagination a', function (e) {
		e.preventDefault();
		page = $(this).attr('href').split('page=')[1];
		var filtro = $('#buscar').val();
		
		generarTabla(page, filtro);
	});

	function generarTabla(page, filtro) {
		$.ajax({
			headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
			url: '{{ url('rubros') }}',
			type: 'GET',
			data: {'page':page, 'filtro':filtro},
			dataType: 'json',
			beforeSend: function () {
                $('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            					 '</div>');
            },
			success: function (data) {
				$('#tabla').html(data);
				$('.overlay').detach();
			}
		});
	}

	$('#buscar').on('keyup', function () {
		var filtro = $('#buscar').val();

		generarTabla(1, filtro);
	});	

</script>