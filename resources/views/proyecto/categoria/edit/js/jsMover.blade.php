<script type="text/javascript">

function moverArriba(id) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('apu/moverArriba') }}/' + id,
		type: 'POST',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
		},
		success: function () {
			var filtro = $('#buscarCategoria').val();
			$('.overlay').detach();
			generarTabla(page, filtro);
		},
		error: function (data) {
			$('.overlay').detach();
			mensaje('error', data, '#mensaje');
		}
	});
}

function moverAbajo(id) {
	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('apu/moverAbajo') }}/' + id,
		type: 'POST',
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              						'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
		},
		success: function () {
			var filtro = $('#buscarCategoria').val();
			$('.overlay').detach();
			generarTabla(page, filtro);
		},
		error: function (data) {
			$('.overlay').detach();
			mensaje('error', data, '#mensaje');
		}
	});
}
	
</script>