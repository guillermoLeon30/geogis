@extends('plantilla.principal')

@section('css')
	@include('proyecto.categoria.apu.edit.css.css')
@endsection

@section('encabezadoContenido')
	
	<section class="content-header">
		<h1>APU</h1> 

		<ol  class="breadcrumb">
			<li><a href="{{ url('proyecto') }}">Proyectos</a></li>
			<li><a href="{{ url('proyecto') }}/{{ $apu->categoria->proyecto->id }}/edit">Categorias</a></li>
			<li><a href="{{ url('categoria') }}/{{ $apu->categoria->id }}/edit">APUS</a></li>
			<li class="active">Editar</li>
		</ol>

		<br>

		<div class="box-tools">
			<button id="btnGuardar" class="btn btn-success" onclick="guardar()">
				<i class="fa fa-save"></i>
			</button>
		</div>

	</section>

@endsection

@section('contenido')
	<div class="row">
		<div class="col-sm-9" id="mensaje"></div>

		<!-- Nav tabs -->
		<div class="col-sm-11">
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
				    	@include('proyecto.categoria.apu.edit.include.datos')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="equipos">
				    	@include('proyecto.categoria.apu.edit.include.equipos')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="materiales">
				    	@include('proyecto.categoria.apu.edit.include.materiales')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="mano_de_obra">
				    	@include('proyecto.categoria.apu.edit.include.mano_de_obra')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="transporte">
				    	@include('proyecto.categoria.apu.edit.include.transporte')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="costos">
				    	@include('proyecto.categoria.apu.edit.include.costos')
				    </div>
				</div>
			</div>
		</div>
	</div>

	@include('proyecto.categoria.apu.edit.include.modalIngresarEquipos')
	@include('proyecto.categoria.apu.edit.include.modalIngresarMateriales')
	@include('proyecto.categoria.apu.edit.include.modalIngresarManoDeObra')
	@include('proyecto.categoria.apu.edit.include.modalIngresarTransporte')
@endsection

@push('js')
	@include('proyecto.categoria.apu.edit.js.js')
	@include('proyecto.categoria.apu.edit.js.jsTabEquipos')
	@include('proyecto.categoria.apu.edit.js.jsTabMateriales')
	@include('proyecto.categoria.apu.edit.js.jsTabManoDeObra')
	@include('proyecto.categoria.apu.edit.js.jsTransporte')
	@include('proyecto.categoria.apu.edit.js.jsTabCostos')
	@include('proyecto.categoria.apu.edit.js.jsPrincipal')
@endpush	