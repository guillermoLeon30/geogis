@extends('plantilla.principal')

@section('css')
	@include('usuarios.roles.create.css.css')
@endsection

@section('encabezadoContenido')
	
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Nuevo Rol</h2>

		<div class="box-tools">
			<button id="btnGuardar" class="btn btn-success" onclick="guardar()">
				<i class="fa fa-save"></i>
				Guardar
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
		                    <input id="nombre" type="text" class="form-control">
		                  </div>
		                </div>

		                <div class="form-group">
		                  <label class="col-sm-2 control-label">Descripción</label>

		                  <div class="col-sm-10">
		                    <input id="descripcion" type="text" class="form-control">
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
	              		</tbody>
	              	</table>
	            </div>
	        </div>
		</div>
		
	</div>
	
	@include('usuarios.roles.create.include.modalIngresarPermiso')
	
	@foreach($permisos as $permiso)
	  <input id="permisoId{{ $permiso->id }}" type="hidden" value="{{ $permiso->descripcion }}">
	@endforeach
@endsection

@push('js')
	@include('usuarios.roles.create.js.js')
	@include('usuarios.roles.create.js.jsModalIngresarPermiso')
	@include('usuarios.roles.create.js.jsPrincipal')
@endpush