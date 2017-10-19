<script type="text/javascript">

	function mensaje(tipo, data, lugar) {
		var tipoAlerta, icono, titulo, html, mensajes='';

		if (tipo == 'ok') {
			tipo = 'alert alert-success alert-dismissible';
			icono = 'icon fa fa-check';
			titulo = 'Exito!';
			mensajes = data.mensaje;

		}else if (tipo == 'error') {
			tipo = 'alert alert-danger alert-dismissible';
			icono = 'icon fa fa-ban';
			titulo = 'Alerta!';
			var arrayMensajes = data.responseJSON;
			mensajes = '<ul>';
			$.each(arrayMensajes, function (i, reg) {
				mensajes +=	'<li>'+reg+'</li>';
			});
			mensajes += '</ul>';
		}

		var html = 	'<div class="'+tipo+'">'+
		            	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
		            	'<h4><i class="'+icono+'"></i> '+titulo+'</h4>'+
		            	mensajes+
		            '</div>';
		        	
		$(lugar).html(html); 
	}

	function mensaje2(tipo, mensaje, lugar) {
		var tipoAlerta, icono, titulo, html, mensajes='';

		if (tipo == 'ok') {
			tipo = 'alert alert-success alert-dismissible';
			icono = 'icon fa fa-check';
			titulo = 'Exito!';
		}else if (tipo == 'error') {
			tipo = 'alert alert-danger alert-dismissible';
			icono = 'icon fa fa-ban';
			titulo = 'Alerta!';
		}

		var html = 	'<div class="'+tipo+'">'+
		            	'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
		            	'<h4><i class="'+icono+'"></i> '+titulo+'</h4>'+
		            	mensaje+
		            '</div>';
		        	
		$(lugar).html(html); 
	}	

</script>