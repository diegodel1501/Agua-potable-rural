@extends('layouts.admin')
@extends('layouts.estatico')
@section('ubicacion')
    <li class="breadcrumb-item"><a href="#">Administracion</a></li>
               <li class="breadcrumb-item"><a href="{{url('valorm3')}}">valor por metro cubico</a></li>
              <li class="breadcrumb-item active">nuevo</li>
@endsection
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Nuevo valor</h3>
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
<form class="form" action="{{route('valor.store')}}" method="POST" autocomplete="off" >
				
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" required value="{{old('nombre')}}">
			</div>
		
			<div class="form-group">
				<label for="descripcion">descripcion</label>
				<input type="textarea" name="descripcion" class="form-control" required value="{{old('descripcion')}}">
			</div>
			
			<div class="form-group">
				<label for="precio">precio</label>
				<input type="number" name="precio" class="form-control" required value="{{old('precio')}}">
			</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('valorm3')}}" class="btn btn-danger">cancelar</a>
		</div>
	
</form>
@endsection



