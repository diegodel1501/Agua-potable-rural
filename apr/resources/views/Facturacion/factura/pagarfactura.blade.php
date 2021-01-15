@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">pagar factura de la vivienda: {{$vivienda->direccion}}</h3>
        </div>
    
        <div class="card-body">
        	<div class="form-group text-center">
        		<label>El saldo a pagar, facturado el: {{$factura->fecha}}, es de: ${{$factura->totalcobrado}}, del cual registra una deuda de: ${{$deuda}}</label>
        	</div>
        	
        	<form action="{{route('factura.ingresarpago')}}" method="post">
        		@csrf
        		<input type="hidden" name="factura" value="{{$factura->idfactura}}">
                <input type="hidden" name="vivienda" value="{{$factura->idvivienda}}">
                <input type="hidden" name="totalcobrado" value="{{$deuda}}">
        		<div class="form-group ">
        				<label> ingrese el monto que desea abonar.</label>
        				<input  class="form-control md-6" type="number" name="montopagado" placeholder="${{$deuda}}" required>
        				
        		</div>
        		<div class="form-group text-center"> 
        			<button type="submit" class="btn btn-success">pagar</button>
        		</div>
        	
        		
        	</form>
        </div>
    </div>


@endsection
 @push('estilos')
    <link rel="stylesheet" href="{{url('adminlte/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link href="{{ asset('css/factura.css') }}" rel="stylesheet">
    @endpush
    @push('scripts')
    <script src="{{url('adminlte/plugins/sweetalert2/sweetalert2@10.js')}}"></script>

<script >
$( document ).ready(function() {
    //quitamo lo active anteriores y reponemos los neesarios
    $(".nav-link").removeClass("active");
    $(".administradorpositivoidentificador").addClass("active");
       $("#reportesopcionabrircerrar").removeClass("menu-open");
    $("#administracionopcionabrircerrar").removeClass("menu-open");
//agregamos el active de la seccion
  $("#menufacturacion").addClass("active");
});
</script>
@endpush