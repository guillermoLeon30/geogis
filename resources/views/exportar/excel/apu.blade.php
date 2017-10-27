<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>APU</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Costo/Hr</th>
				<th>Rendimiento</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->equipos as $equipo)
				<tr>
					<td>{{ $equipo->descripcion }}</td>
					<td>{{ $equipo->pivot->cantidad }}</td>
					<td>{{ $equipo->pivot->costo_hora2 }}</td>
					<td>{{ $equipo->pivot->rendimiento }}</td>
					<td>{{ $equipo->pivot->cantidad*$equipo->pivot->costo_hora2*$equipo->pivot->rendimiento }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<table>
		<thead>
			<tr>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Jornal/Hr</th>
				<th>Rendimiento</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->manoDeObra as $mano)
				<tr>
					<td>{{ $mano->descripcion }}</td>
					<td>{{ $mano->pivot->cantidad }}</td>
					<td>{{ $mano->pivot->costo_hora2 }}</td>
					<td>{{ $mano->pivot->rendimiento }}</td>
					<td>{{ $mano->pivot->cantidad*$mano->pivot->costo_hora2*$mano->pivot->rendimiento }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<table>
		<thead>
			<tr>
				<th>Descripcion</th>
				<th>Unidad</th>
				<th>Costo/Unidad</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->materiales as $material)
				<tr>
					<td>{{ $material->descripcion }}</td>
					<td>{{ $material->unidad }}</td>
					<td>{{ $material->pivot->costo2 }}</td>
					<td>{{ $material->pivot->cantidad }}</td>
					<td>{{ $material->pivot->cantidad * $material->pivot->costo2 }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<table>
		<thead>
			<tr>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Tarifa(M3/KM)</th>
				<th>Distancia(Km)</th>
				<th>Costo</th>
			</tr>
		</thead>

		<tbody>
			@foreach($apu->transportes as $transporte)
				<tr>
					<td>{{ $transporte->descripcion }}</td>
					<td>{{ $transporte->pivot->cantidad }}</td>
					<td>{{ $transporte->pivot->costo_km2 }}</td>
					<td>{{ $transporte->unidad }}</td>
					<td>{{ $transporte->pivot->cantidad * $transporte->pivot->costo_km2 }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>