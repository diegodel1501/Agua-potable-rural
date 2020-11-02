@extends('layouts.admin')
@extends('Administracion.subsidio.estatico')
@section('ubicacion')
    <li class="breadcrumb-item"><a href="#">Administracion</a></li>
               <li class="breadcrumb-item"><a href="#">Medicion</a></li>
              <li class="breadcrumb-item active">editar</li>
@endsection
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Editar medicion de la vivienda: {{$medicion->direccion}}, registrada en la fecha: {{$medicion->fechadeingreso}}</h3>
		@if(count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>
	<form class="form" action="{{route('medicion.update', $medicion->idmedicion)}}" method="POST" autocomplete="off" >
				@method('PUT')
		<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="valordemedicion">valor de la medicion</label>
				<input type="number" name="valordemedicion" class="form-control" required value="{{$medicion->valordemedicion}}">
			</div>
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('medicion')}}" class="btn btn-danger">cancelar</a>
		</div>
	
	
	
</form>

@endsection