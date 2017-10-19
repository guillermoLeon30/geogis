@extends('plantilla.principal')

@section('css')
	@include('biblioteca_apus.edit.css.css')
@endsection

@section('encabezadoContenido')
	
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Editar APU</h2>

		<div class="box-tools">
			<button id="btnGuardar" class="btn btn-success" onclick="guardar()">
				<i class="fa fa-save"></i>
			</button>
		</div>

		<h4>
			<ol id="bread" class="breadcrumb">
			  <li><a href="{{ url('biblioteca_apus') }}">APUs</a></li>
			  <li class="active">Editar</li>
			</ol>
		</h4>

	</div>

	
@endsection

@section('contenido')
	<div class="row">
		<div class="col-sm-9" id="mensaje"></div>

		<!-- Nav tabs -->
		<div class="col-sm-10">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#datos" aria-controls="home" role="tab" data-toggle="tab">Datos</a></li>
				    <li role="presentation"><a href="#equipos" aria-controls="home" role="tab" data-toggle="tab">Equipos</a></li>
				    <li role="presentation"><a href="#materiales" aria-controls="profile" role="tab" data-toggle="tab">Materiales</a></li>
				    <li role="presentation"><a href="#mano_de_obra" aria-controls="messages" role="tab" data-toggle="tab">Mano de Obra</a></li>
				    <li role="presentation"><a href="#transporte" aria-controls="settings" role="tab" data-toggle="tab">Transporte</a></li>
				    <li role="presentation"><a href="#costos" aria-controls="settings" role="tab" data-toggle="tab">Costos</a></li>
				</ul>

				  <!-- Tab panes -->
				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="datos">
				    	@include('biblioteca_apus.edit.include.datos')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="equipos">
				    	@include('biblioteca_apus.edit.include.equipos')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="materiales">
				    	@include('biblioteca_apus.edit.include.materiales')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="mano_de_obra">
				    	@include('biblioteca_apus.edit.include.mano_de_obra')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="transporte">
				    	@include('biblioteca_apus.edit.include.transporte')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="costos">
				    	@include('biblioteca_apus.edit.include.costos')
				    </div>
				</div>
			</div>
		</div>
	</div>

	@include('biblioteca_apus.edit.include.modalIngresarEquipos')
	@include('biblioteca_apus.edit.include.modalIngresarMateriales')
	@include('biblioteca_apus.edit.include.modalIngresarManoDeObra')
	@include('biblioteca_apus.edit.include.modalIngresarTransporte')
@endsection

@push('js')
	@include('biblioteca_apus.edit.js.js')
	@include('biblioteca_apus.edit.js.jsTabEquipos')
	@include('biblioteca_apus.edit.js.jsTabMateriales')
	@include('biblioteca_apus.edit.js.jsTabManoDeObra')
	@include('biblioteca_apus.edit.js.jsTransporte')
	@include('biblioteca_apus.edit.js.jsTabCostos')
	@include('biblioteca_apus.edit.js.jsPrincipal')
@endpush	