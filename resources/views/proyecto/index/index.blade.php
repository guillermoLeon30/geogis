@extends('plantilla.principal')

@section('css')
	@include('proyecto.index.css.css')
@endsection

@section('encabezadoContenido')
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Proyectos</h2>

		
			<div class="box-tools">
				<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modalNuevo">
				 	<i class="glyphicon glyphicon-plus"></i>
					Nuevo
				</button>
			</div>
		

	</div>
@endsection

@section('contenido')
	<div class="row">
		<div class="col-xs-12 col-lg-9 col-md-9 col-sm-9" id="mensaje"></div>

		<div class="col-sm-11 col-xs-12">

			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Listado</h3>

		            <div class="box-tools">
		                <div class="input-group input-group-sm" style="width: 150px;">
		                  <input id="buscar" type="text" class="form-control pull-right" placeholder="Buscar">

		                  <div class="input-group-btn">
		                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
		                  </div>
		                </div>
		            </div>
				</div>

				<div id="tabla">
					@include('proyecto.index.include.tabla')
				</div>
			
			</div>

		</div>
	</div>

	@include('proyecto.index.include.modalNuevo')
	@include('proyecto.index.include.modalEliminar')
@endsection

@push('js')
	@include('proyecto.index.js.js')
	@include('proyecto.index.js.jsPrincipal')
	@include('proyecto.index.js.jsModalNuevo')
@endpush	