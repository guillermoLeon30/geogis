<script type="text/javascript">
	
function costos() {
	var Equipos = Number(costoEquipos());
	var Materiales = Number(costoMateriales());
	var ManoObra = Number(costoMano());
	var Transporte = Number(costoTransporte());
	var total = Equipos + Materiales + ManoObra + Transporte;
	var porIndirectos = $('#indirectos').val();
	var total2 = total + total * porIndirectos/100;

	$('#costoEquipos').val(Equipos);
	$('#costoMateriales').val(Materiales);
	$('#costoManoObra').val(ManoObra);
	$('#totalTransporte').val(Transporte);
	$('#totalCostos').val(total.toFixed(2));
	costoIndirectos();
}

function costoEquipos() {
	var total=0;

	for (var i = 0; i < equipos.length; i++) {
		if (typeof(equipos[i]) !== "undefined") {
			total=total+equipos[i].datos.cantidad*equipos[i].datos.costoHora*equipos[i].datos.rendimiento/100;	
		}
	}

	return total.toFixed(2);
}

function costoMateriales() {
	var total=0;

	for (var i = 0; i < materiales.length; i++) {
		if (typeof(materiales[i]) !== "undefined") {
			total = total + materiales[i].cantidad * materiales[i].costo;	
		}
	}

	return total.toFixed(2);
}

function costoMano() {
	var total=0;

	for (var i = 0; i < manos.length; i++) {
		if (typeof(manos[i]) !== "undefined") {
			total=total+manos[i].datos.cantidad*manos[i].datos.costo*manos[i].datos.rendimiento/100;
		}
	}

	return total.toFixed(2);
}

function costoTransporte() {
	var total=0;

	for (var i = 0; i < transportes.length; i++) {
		if (typeof(transportes[i]) !== "undefined") {
			total=total+transportes[i].cantidad*transportes[i].costo;
		}
	}

	return total.toFixed(2);
}

function costoIndirectos() {
	var subTotal = $('#totalCostos').val();
	var porIndirecto = $('#porIndirecto').val();
	var indirectos = subTotal * porIndirecto / 100;
	
	$('#indirectos').val(indirectos.toFixed(2));
	total();
}

function total() {
	var subTotal = Number($('#totalCostos').val());
	var indirectos = Number($('#indirectos').val());
	var total = subTotal + indirectos;

	$('#total').val(total.toFixed(2));
}

</script>