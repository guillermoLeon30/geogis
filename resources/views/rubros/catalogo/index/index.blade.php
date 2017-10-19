@extends('plantilla.principal')

@section('encabezadoContenido')
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Rubros</h2>

		<div class="box-tools">
			<button id="btnNuevo" class="btn btn-success pull-right" type="button" data-toggle="modal" data-target="#modalIngresarRubro">
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
		                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
		                  </div>
		                </div>
		            </div>
				</div>

				<div id="tabla">
					@include('rubros.catalogo.index.include.rubros')
				</div>
			
			</div>

		</div>
	</div>

	@include('rubros.catalogo.index.include.modalIngresarRubro')
	@include('rubros.catalogo.index.include.modalEditarRubro')
	@include('rubros.catalogo.index.include.modalEliminarRubro')
@endsection

@push('js')
	@include('rubros.catalogo.index.js.js')
	@include('rubros.catalogo.index.js.jsPrincipal')
	@include('rubros.catalogo.index.js.jsModalIngresarRubro')
	@include('rubros.catalogo.index.js.jsModalEditarRubro')
	@include('rubros.catalogo.index.js.jsModalEliminarRubro')
@endpush