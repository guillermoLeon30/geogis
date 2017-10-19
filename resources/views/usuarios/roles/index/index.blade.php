@extends('plantilla.principal')

@section('encabezadoContenido')
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Roles</h2>

		@can('create', new App\Models\Rol)
			<div class="box-tools">
				<a class="btn btn-success pull-right" href="{{ url('roles/create') }}">
					<i class="glyphicon glyphicon-plus"></i>
					Nuevo
				</a>
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
		                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
		                  </div>
		                </div>
		            </div>
				</div>

				<div id="tabla">
					@include('usuarios.roles.index.include.roles')
				</div>
			
			</div>

		</div>
	</div>

	@include('usuarios.roles.index.include.modalEliminarRol')
@endsection

@push('js')
	@include('usuarios.roles.index.js.js')
	@include('usuarios.roles.index.js.jsPrincipal')
	@include('usuarios.roles.index.js.jsModalEliminarRubro')
@endpush