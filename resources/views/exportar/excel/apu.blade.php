<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>APU</title>
	@include('exportar.excel.css.apu')
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>DIRECCION DE OPERACIONES TECNICAS</th>
			</tr>

			<tr>
				<th>ANALISIS DE PRECIOS UNITARIOS</th>
			</tr>

			<tr>
				<th>RUBRO:</th>
				<td width="8.43">???</td>
			</tr>

			<tr>
				<th height="30">DESCRIPCION:</th>
				<td>{{ $apu->descripcion }}</td>
			</tr>
			
			<tr>
				<th>UNIDAD:</th>
				<td>{{ $apu->unidad }}</td>
			</tr>
		</thead>
	</table>

	<table>
		<thead>
			<tr>
				<th colspan="7">EQUIPOS</th>
			</tr>
			<tr>
				<th colspan="3">Descripcion</th>
				<th>Cantidad</th>
				<th>Costo/Hr</th>
				<th>Rendimiento</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->equipos as $equipo)
				<tr>
					<td colspan="3">{{ $equipo->descripcion }}</td>
					<td>{{ $equipo->pivot->cantidad }}</td>
					<td>{{ $equipo->pivot->costo_hora2 }}</td>
					<td>{{ $equipo->pivot->rendimiento }}</td>
					<td>{{ $equipo->pivot->cantidad*$equipo->pivot->costo_hora2*$equipo->pivot->rendimiento }}</td>
				</tr>
			@endforeach
		</tbody>

		<tfoot>
			<tr>
				<td></td><td></td><td></td><td></td>
				<th>Subtotal</th>
				<td>{{ $apu->totalEquipo() }}</td>
			</tr>
		</tfoot>
	</table>

	<table>
		<thead>
			<tr>
				<th colspan="7">MANO DE OBRA</th>
			</tr>
			<tr>
				<th colspan="3">Descripcion</th>
				<th>Cantidad</th>
				<th>Jornal/Hr</th>
				<th>Rendimiento</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->manoDeObra as $mano)
				<tr>
					<td colspan="3">{{ $mano->descripcion }}</td>
					<td>{{ $mano->pivot->cantidad }}</td>
					<td>{{ $mano->pivot->costo_hora2 }}</td>
					<td>{{ $mano->pivot->rendimiento }}</td>
					<td>{{ $mano->pivot->cantidad*$mano->pivot->costo_hora2*$mano->pivot->rendimiento }}</td>
				</tr>
			@endforeach
		</tbody>

		<tfoot>
			<tr>
				<td></td><td></td><td></td><td></td>
				<th>Subtotal</th>
				<td>{{ $apu->totalManoDeObra() }}</td>
			</tr>
		</tfoot>
	</table>

	<table>
		<thead>
			<tr>
				<th colspan="7">MATERIALES</th>	
			</tr>

			<tr>
				<th colspan="3">Descripcion</th>
				<th>Unidad</th>
				<th>Costo/Unidad</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->materiales as $material)
				<tr>
					<td colspan="3">{{ $material->descripcion }}</td>
					<td>{{ $material->unidad }}</td>
					<td>{{ $material->pivot->costo2 }}</td>
					<td>{{ $material->pivot->cantidad }}</td>
					<td>{{ $material->pivot->cantidad * $material->pivot->costo2 }}</td>
				</tr>
			@endforeach
		</tbody>

		<tfoot>
			<tr>
				<td></td><td></td><td></td><td></td>
				<th>Subtotal</th>
				<td>{{ $apu->totalMateriales() }}</td>
			</tr>
		</tfoot>
	</table>

	<table>
		<thead>
			<tr>
				<th colspan="7">TRANSPORTES</th>
			</tr>
			<tr>
				<th colspan="3">Descripcion</th>
				<th>Cantidad</th>
				<th>Tarifa(M3/KM)</th>
				<th>Distancia(Km)</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->transportes as $transporte)
				<tr>
					<td colspan="3">{{ $transporte->descripcion }}</td>
					<td>{{ $transporte->pivot->cantidad }}</td>
					<td>{{ $transporte->pivot->costo_km2 }}</td>
					<td>{{ $transporte->unidad }}</td>
					<td>{{ $transporte->pivot->cantidad * $transporte->pivot->costo_km2 }}</td>
				</tr>
			@endforeach
		</tbody>

		<tfoot>
			<tr>
				<td></td><td></td><td></td><td></td>
				<th>Subtotal</th>
				<td>{{ $apu->totalTransportes() }}</td>
			</tr>
			<tr>
				<td></td><td></td><td></td>
				<td colspan="2">TOTAL COSTO DIRECTO</td>
				<td>{{ $apu->total() }}</td>
			</tr>
			<tr>
				<td></td><td></td><td></td>
				<td>INDIRECTOS%</td>
				<td>{{ $apu->por_indirectos }}</td>
				<td>{{ $apu->totalIndirectos() }}</td>
			</tr>
			<tr>
				<td></td><td></td><td></td>
				<td>UTILIDAD%</td>
				<td>{{ $apu->por_utilidad }}</td>
				<td>{{ $apu->totalUtilidad() }}</td>
			</tr>
			<tr>
				<td></td><td></td><td></td>
				<td colspan="2">COSTO TOTAL DEL RUBRO</td>
				<td>{{ $apu->totalGeneral() }}</td>
			</tr>
		</tfoot>
	</table>
</body>
</html>