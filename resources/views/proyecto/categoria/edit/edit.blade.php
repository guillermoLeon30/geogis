@extends('plantilla.principal')

@section('css')
	@include('proyecto.edit.css.css')
@endsection

@section('encabezadoContenido')
	
	<section class="content-header">
		<h1>Categoria</h1> 

		<ol  class="breadcrumb">
			<li><a href="{{ url('proyecto') }}">Proyectos</a></li>
			<li><a href="{{ url('proyecto') }}/{{ $categoria->proyecto->id }}/edit">Categorias</a></li>
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
				    <li role="presentation"><a href="#apus" aria-controls="home" role="tab" data-toggle="tab">Apus</a></li>
				</ul>

				  <!-- Tab panes -->
				<div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="datos">
				    	@include('proyecto.categoria.edit.include.tabDatos')
				    </div>
				    <div role="tabpanel" class="tab-pane" id="apus">
				    	@include('proyecto.categoria.edit.include.tabApus')
				    </div>
				</div>
			</div>
		</div>
	</div>

	@include('proyecto.categoria.edit.include.modalIngresarApu')
	@include('proyecto.categoria.edit.include.modalCopiarApu')
	@include('proyecto.categoria.edit.include.modalEliminar')
@endsection

@push('js')
	@include('proyecto.categoria.edit.js.js')
	@include('proyecto.categoria.edit.js.jsTabDatos')
	@include('proyecto.categoria.edit.js.jsModalIngresarApu')
	@include('proyecto.categoria.edit.js.jsModalCopiarApu')
	@include('proyecto.categoria.edit.js.jsModalEliminar')
	@include('proyecto.categoria.edit.js.jsPrincipal')
@endpush