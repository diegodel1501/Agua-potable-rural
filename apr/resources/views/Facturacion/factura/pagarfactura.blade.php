@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">pagar factura de la vivienda: {{$vivienda->direccion}}</h3>
        </div>
    
        <div class="card-body">
        	<div class="form-group text-center">
        		<label>El saldo a pagar, facturado el: {{$factura->fecha}}, es de: ${{$factura->totalcobrado}}</label>
        	</div>
        	
        	<form action="{{route('factura.ingresarpago')}}" method="post">
        		@csrf
        		<input type="hidden" name="factura" value="{{$factura->idfactura}}">
        		<input type="hidden" name="vivienda" value="{{$factura->idvivienda}}">
        		<div class="form-group ">
        				<label> ingrese el monto que desea abonar.</label>
        				<input  class="form-control md-6" type="number" name="montopagado" placeholder="${{$factura->totalcobrado}}" required>
        				
        		</div>
        		<div class="form-group text-center"> 
        			<button type="submit" class="btn btn-success">pagar</button>
        		</div>
        	
        		
        	</form>
        </div>
    </div>


@endsection