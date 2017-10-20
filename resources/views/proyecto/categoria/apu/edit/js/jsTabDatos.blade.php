<script type="text/javascript">
	
function calculoApu() {
	var cantidad = $('#cantidadApu').val();
/*	if (cantidad < 0.01) {
		$('#cantidadApu').val('{{ $apu->cantidad }}');
		return;
	}*/
	var total = $('#total').val();	
	var tApu = total * cantidad;

	$('#totalApu').val(tApu.toFixed(2));
}

</script>