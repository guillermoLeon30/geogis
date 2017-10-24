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
	var eqs = equipos();
	var total=0;

	for (var i = 0; i < eqs.length; i++) {
		total = total + eqs[i].cantidad * eqs[i].costo * eqs[i].rendimiento;
	}

	return total.toFixed(2);
}

function costoMateriales() {
	var mts = materiales();
	var total=0;

	for (var i = 0; i < mts.length; i++) {
		total = total + mts[i].cantidad * mts[i].costo;
	}

	return total.toFixed(2);
}

function costoMano() {
	var mns = manos();
	var total=0;

	for (var i = 0; i < mns.length; i++) {
		total = total + mns[i].cantidad * mns[i].costo * mns[i].rendimiento;
	}

	return total.toFixed(2);
}

function costoTransporte() {
	var trans = transportes();
	var total=0;

	for (var i = 0; i < trans.length; i++) {
		total = total + trans[i].cantidad * trans[i].costo;
	}
	
	return total;
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