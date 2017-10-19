<script type="text/javascript">

$('#formDatos').submit(function (e) {
	e.preventDefault();
	
	var datos = $(this).serialize();

	$.ajax({
		headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}'},
		url: '{{ url('categoria') }}/{{ $categoria->id }}',
		type: 'POST',
		data: datos,
		dataType: 'json',
		beforeSend: function () {
			$('.box').append('<div class="overlay">'+
              					'<i class="fa fa-refresh fa-spin"></i>'+
            				 '</div>');
		},
		success: function (data) {
			var nombre = $('#nombre').val();
			
			$('.overlay').detach();
			$('#titulo').html(nombre);
			mensaje('ok', data, '#mensaje');
		},
		error: function (data) {
			$('.overlay').detach();
			mensaje('error', data, '#mensaje');
		}
	});
});

</script>