<script src="{{asset('js/scripts.js')}}"></script>
@extends('layouts.admin')
@extends('layouts.estatico')
@section('ubicacion')
<li class="breadcrumb-item"><a href="#">Administracion</a></li>
<li class="breadcrumb-item active">vivienda</li>
@endsection
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de viviendas registradas</h3>
		@include('Administracion.vivienda.search')
	</div>	
</div>
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>direccion</th>
					<th>numero de medidor</th>
					<th>tipo de subsidio</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				@foreach($viviendas as $v)
 					<tr>
 						<td>{{$v->idvivienda}}</td>
 						<td>{{$v->direccion}}</td>
 						<td>{{$v->numeromedidor}}</td>
 						<td>{{$v->tipodesubsidio}}</td>
 					<td>
 						<a href="{{route('vivienda.edit',$v->idvivienda)}}"><button class="btn btn-info">editar</button></a>
 				
 							<a href="" data-target="#modal-delete-{{$v->idvivienda}}" data-toggle="modal"><button class="btn btn-danger">eliminar</button></a>
 							@include('administracion.vivienda.modal')
 						</td>
 					</tr>

 					@endforeach
				</tbody>
 			</table>
 		</div>	
 	</div>
 </div>
 <div class="row">
 	  {{$viviendas->render()}}
 </div>

 @endsection