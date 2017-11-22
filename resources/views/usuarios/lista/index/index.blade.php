@extends('plantilla.principal')

@section('encabezadoContenido')
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Usuarios</h2>

		@can('create', new App\User())
			<div class="box-tools">
				<button id="btnNuevo" class="btn btn-success pull-right" type="button" data-toggle="modal" data-target="#modalNuevoUsuario">
					<i class="glyphicon glyphicon-plus"></i>
					Nuevo
				</button>	

			</div>
		@endcan
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
		                    <i class="fa fa-search"></i>
		                  </div>
		                </div>
		            </div>
				</div>

				<div id="tabla">
					@include('usuarios.lista.index.include.usuarios')
				</div>
			
			</div>

		</div>
	</div>

	@include('usuarios.lista.index.include.modalNuevoUsuario')
	@include('usuarios.lista.index.include.modalEditarUsuario')
	@include('usuarios.lista.index.include.modalEliminarUsuario')
@endsection

@push('js')
	@include('usuarios.lista.index.js.js')
	@include('usuarios.lista.index.js.jsPrincipal')
	@include('usuarios.lista.index.js.jsmodalNuevoUsuario')
	@include('usuarios.lista.index.js.jsModalEditarUsuario')
	@include('usuarios.lista.index.js.jsModalEliminarUsuario')
@endpush