@extends('plantilla.principal')

@section('css')
	@include('biblioteca_apus.index.css.css')
@endsection

@section('encabezadoContenido')
	<div class="box-header">
		<h2 class="box-title" style="font-size: 30px">Biblioteca de APUs</h2>

		
			<div class="box-tools">
				<a href="{{ url('biblioteca_apus/create') }}" class="btn btn-success pull-right">
					<i class="glyphicon glyphicon-plus"></i>
					Nuevo
				</a>
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
					@include('biblioteca_apus.index.include.tabla')
				</div>
			
			</div>

		</div>
	</div>

	@include('biblioteca_apus.index.include.modalEliminar')
@endsection

@push('js')
	@include('biblioteca_apus.index.js.js')
	@include('biblioteca_apus.index.js.jsPrincipal')
	@include('biblioteca_apus.index.js.jsModalEliminar')
@endpush	