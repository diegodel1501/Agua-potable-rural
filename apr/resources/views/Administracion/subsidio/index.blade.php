@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de subsidios registrados</h3>
		@include('Administracion.subsidio.search')
	</div>	
</div>
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>tipo de subsidio</th>
					<th>descripcion</th>
					<th>porcentaje de descuento</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				@foreach($subsidios as $s)
 					<tr>
 						<td>{{$s->idsubsidio}}</td>
 						<td>{{$s->tipodesubsidio}}</td>
 						<td>{{$s->descripcion}}</td>
 						<td>{{$s->porcentajededescuento}}</td>
 					<td>
 						<a href="{{route('subsidio.edit',$s->idsubsidio)}}"><button class="btn btn-info">editar</button></a>
 				
 							<a href="" data-target="#modal-delete-{{$s->idsubsidio}}" data-toggle="modal"><button class="btn btn-danger">eliminar</button></a>
 							@include('administracion.subsidio.modal')
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
  $("#menusubsidio").addClass("active");
});
</script>
@endpush