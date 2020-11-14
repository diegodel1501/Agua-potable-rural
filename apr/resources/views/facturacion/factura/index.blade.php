@extends('layouts.admin')
@section('contenido')
<div class="container">
	<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de mediciones</h3>
		@include('Administracion.medicion.search')
	</div>	
</div>
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>inscriptor</th>
					<th>valor</th>
					<th>fecha de ingreso</th>
					<th>vivienda</th>
					<th>Opciones</th>
				</thead>
				<tbody>
					@foreach($mediciones as $m)
					<tr>
						<td>{{$m->idmedicion}}</td>
						<td>{{$m->inscriptor}}</td>
						<td>{{$m->valordemedicion}}</td>
						<td>{{$m->fechadeingreso}}</td>
						<td>{{$m->direccion}}</td>
						<td>
							<a href="{{route('medicion.edit',$m->idmedicion)}}"><button class="btn btn-info">editar</button></a>
							
							<a href="" data-target="#modal-delete-{{$m->idmedicion}}" data-toggle="modal"><button class="btn btn-danger">eliminar</button></a>
							@include('administracion.medicion.modal')
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>	
	</div>
</div>
<div class="row">
	{{$mediciones->render()}}
</div>
</div>


@endsection