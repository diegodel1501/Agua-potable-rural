@extends('layouts.admin')
@extends('Administracion.vivienda.estatico')
@section('ubicacion')
<li class="breadcrumb-item"><a href="#">Administracion</a></li>
<li class="breadcrumb-item active">saldo diferenciado</li>
@endsection
@section('contenido')
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado desaldos registrados</h3>
		@include('Administracion.saldodiferenciado.search')
	</div>	
</div>
<div class="row">
	<div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>tipo</th>
					<th>descripcion</th>
					<th>monto</th>
					<th>vivienda</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				@foreach($saldodiferenciados as $s)
 					<tr>
 						<td>{{$s->idsaldodiferenciado}}</td>
 						<td>{{$s->tipo}}</td>
 						<td>{{$s->descripcion}}</td>
 						<td>{{$s->monto}}</td>
 						<td>{{$s->direccion}}</td>
 					<td>
 						<a href="{{route('saldodiferenciado.edit',$s->idsaldodiferenciado)}}"><button class="btn btn-info">editar</button></a>
 				
 							<a href="" data-target="#modal-delete-{{$s->idsaldodiferenciado}}" data-toggle="modal"><button class="btn btn-danger">eliminar</button></a>
 							@include('administracion.saldodiferenciado.modal')
 						</td>
 					</tr>

 					@endforeach
				</tbody>
 			</table>
 		</div>	
 	</div>
 </div>
 <div class="row">
 	  {{$saldodiferenciados->render()}}
 </div>

 @endsection