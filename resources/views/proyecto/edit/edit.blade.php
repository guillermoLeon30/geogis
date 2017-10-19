@extends('plantilla.principal')

@section('css')
	@include('proyecto.edit.css.css')
@endsection

@section('encabezadoContenido')
	
	<section class="content-header">
		<h1>Proyecto</h1> 

		<ol  class="breadcrumb">
			<li><a href="{{ url('proyecto') }}">Proyectos</a></li>
			<li class="active">Editar</li>
		</ol>
	</section>

	
@endsection

@section('contenido')
	<div class="row">
		<div class="col-sm-9" id="mensaje"></div>

		<!-- Nav tabs -->
		<div class="col-sm-10">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#datos" aria-controls="home" role="tab" data-toggle="tab">Datos</a></li>
				    <li role="presentation"><a href="#categorias" aria-controls="home" role="tab" data-toggle="tab">Categorias</a></li>
				    <li role="presentation"><a href="#permisos" aria-controls="profile" role="tab" data-toggle="tab">Permisos</a></li>
				</ul>

				  <!-- Tab panes -->
				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="datos">
				    	@include('proyecto.edit.include.tabDatos')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="categorias">
				    	@include('proyecto.edit.include.tabCategorias')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="permisos">
				    	@include('proyecto.edit.include.tabPermisos')
				    </div>
				</div>
			</div>
		</div>
	</div>

	@include('proyecto.edit.include.modalIngresarCategoria')
	@include('proyecto.edit.include.modalIngresarPermiso')
	@include('proyecto.edit.include.modalEliminarPermiso')
@endsection

@push('js')
	@include('proyecto.edit.js.js')
	@include('proyecto.edit.js.jsModalIngresoCategoria')
	@include('proyecto.edit.js.jsModalIngresoPermiso')
	@include('proyecto.edit.js.jsModalEliminarPermiso')
	@include('proyecto.edit.js.jsTabDatos')
	@include('proyecto.edit.js.jsTabPermisos')
	@include('proyecto.edit.js.jsPrincipal')
@endpush