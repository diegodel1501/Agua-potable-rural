@extends('layouts.admin')
@extends('layouts.estatico')
@section('ubicacion')
    <li class="breadcrumb-item"><a href="#">Administracion</a></li>
               <li class="breadcrumb-item"><a href="{{url('subsidio')}}">subsidio</a></li>
              <li class="breadcrumb-item active">nuevo</li>
@endsection
@section('contenido')
<div class="row">
	<div class="col col-lg-6 col-md-6  col-xs-6">
		<h3>Nuevo subsidio</h3>
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
<form class="form" action="{{route('subsidio.store')}}" method="POST" autocomplete="off" >
				
			<div class="form-group">
				<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
				<label for="porcentajededescuento">porcentaje de descuento</label>
				<input type="text" name="porcentajededescuento" class="form-control" required value="{{old('porcentajededescuento')}}">
			</div>
		
			<div class="form-group">
				<label for="descripcion">descripcion</label>
				<input type="textarea" name="descripcion" class="form-control" required value="{{old('descripcion')}}">
			</div>
			
			<div class="form-group">
				<label for="tipodesubsidio">tipo de subsidio</label>
				<input type="text" name="tipodesubsidio" class="form-control" required value="{{old('tipodesubsidio')}}">
			</div>
	
		<div class="form-group">
			<button class="btn btn-primary" class="form-control" type="submit">guardar</button>
			<a href="{{url('subsidio')}}" class="btn btn-danger">cancelar</a>
		</div>
	
</form>
@endsection



