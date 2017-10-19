@extends('plantilla.principal')

@section('css')
	@include('usuarios.roles.edit.css.css')
@endsection

@section('encabezadoContenido')
	
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Editar Rol</h2>

		<div class="box-tools">
			<button id="btnGuardar" class="btn btn-success" onclick="editar()">
				<i class="fa fa-save"></i>
				Editar Rol
			</button>
		</div>

		<h4>
			<ol id="bread" class="breadcrumb">
			  <li><a href="{{ url('roles') }}">Roles</a></li>
			  <li class="active">Nuevo</li>
			</ol>
		</h4>

	</div>

	
@endsection

@section('contenido')
	<div class="row">
		<div class="col-sm-9" id="mensaje"></div>

		<div class="col-md-10 col-sm-10">
			<div class="box box-info">
				<div class="box-header with-border">
	              <h3 class="box-title">Rol</h3>
	            </div>
	            <div class="box-body">
	            	<form class="form-horizontal">
	            		<div class="form-group">
		                  <label class="col-sm-2 control-label">Nombre</label>

		                  <div class="col-sm-10">
		                  	<input type="hidden" id="idRol" value="{{ $rol->id }}">
		                    <input id="nombre" type="text" class="form-control" value="{{ $rol->nombre }}">
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label class="col-sm-2 control-label">Descripción</label>

		                  <div class="col-sm-10">
		                    <input id="descripcion" type="text" class="form-control" value="{{ $rol->desripicion }}">
		                  </div>
		                </div>
	            	</form>
	            </div>
			</div>			
		</div>

		<div class="col-md-10 col-sm-10">
			<div class="box box-warning">
	            <div class="box-header">
	              	<h3 class="box-title">Permisos</h3>

		            <div class="box-tools">
		                <button type="button" data-toggle="modal" data-target="#modalIngresarPermiso" class="btn btn-success">
		                	<i class="glyphicon glyphicon-plus"></i>
		                </button>
		            </div>
	            </div>
	            
	            <div class="box-body table-responsive no-padding">
	              	<table class="table table-hover">
		              	<thead>
		              		<tr>
		              			<th>Nombre</th>
		              			<th>Descripción</th>
		              			<th>Opciones</th>
		              		</tr>
		              	</thead>

	                	<tbody id="tabla">
	                		@include('usuarios.roles.edit.include.permisos')
	              		</tbody>
	              	</table>
	            </div>
	        </div>
		</div>
		
	</div>
	
	@include('usuarios.roles.edit.include.modalIngresoPermiso')
	
	@foreach($permisos as $permiso)
	  <input id="permisoId{{ $permiso->id }}" type="hidden" value="{{ $permiso->descripcion }}">
	@endforeach
@endsection

@push('js')
	@include('usuarios.roles.edit.js.js')
	@include('usuarios.roles.edit.js.jsModalIngresarPermiso')
	@include('usuarios.roles.edit.js.jsPrincipal')
@endpush