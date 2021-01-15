@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Historial de consumo comite buli oriente</h3>
        </div>
    
        <div class="card-body">
            <table class="table table-striped table-condensed">
                <thead>
                </thead>
                <tbody>
                </tbody>
               
            </table>
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
     $("#facturacionopcionabrircerrar").removeClass("menu-open");
    $("#administracionopcionabrircerrar").removeClass("menu-open");
//agregamos el active de la seccion
  $("#menuhistorialdeconsumo").addClass("active");
});
</script>
@endpush