@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de socios registrados</h3>
		@include('Administracion.representante.search')
	</div>	
</div>
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>nombre</th>
					<th>rut</th>
					<th>email</th>
					<th>telefono</th>
					<th>direccion</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				@foreach($representantes as $r)
 					<tr>
 						<td>{{$r->idrepresentante}}</td>
 						<td>{{$r->nombre}}</td>
 						<td>{{$r->rut}}</td>
 						<td>{{$r->email}}</td>
 						<td>{{$r->telefono}}</td>
 						<td>{{$r->direccion}}</td>
 					<td>
 						<a href="{{route('representante.edit',$r->idrepresentante)}}"><button class="btn btn-info">editar</button></a>
 				
 							<a href="" data-target="#modal-delete-{{$r->idrepresentante}}" data-toggle="modal"><button class="btn btn-danger">eliminar</button></a>
 							@include('administracion.representante.modal')
 						</td>
 					</tr>

 					@endforeach
				</tbody>
 			</table>
 		</div>	
 	</div>
 </div>

 @endsection
    @push('scripts')
<script >
$( document ).ready(function() {
	//quitamo lo active anteriores y reponemos los neesarios
	$(".nav-link").removeClass("active");
	$(".administradorpositivoidentificador").addClass("active");
//agregamos el active de la seccion
  $("#menurepresentante").addClass("active");
});
</script>
@endpush