@extends('layouts.admin')
@extends('Administracion.subsidio.estatico')
@section('ubicacion')
    <li class="breadcrumb-item"><a href="#">Administracion</a></li>
               <li class="breadcrumb-item"><a href="#">subsidio</a></li>
              <li class="breadcrumb-item active">editar</li>
@endsection
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Editar valor: {{$subsidio->tipodesubsidio}}</h3>
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
	<form class="form" action="{{route('subsidio.update', $subsidio->idsubsidio)}}" method="POST" autocomplete="off" >
				@method('PUT')
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="tipodesubsidio">tipo de subsidio</label>
				<input type="text" name="tipodesubsidio" class="form-control" required value="{{$subsidio->tipodesubsidio}}">
			</div>
		
			<div class="form-group">
				<label for="descripcion">descripcion</label>
				<input type="textarea" name="descripcion" class="form-control" required value="{{$subsidio->descripcion}}">
			</div>
			
			<div class="form-group">
				<label for="porcentajededescuento">porcentaje de subsidio</label>
				<input type="number" name="porcentajededescuento" class="form-control" required value="{{$subsidio->porcentajededescuento}}">
			</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('subsidio')}}" class="btn btn-danger">cancelar</a>
		</div>
	
</form>

@endsection