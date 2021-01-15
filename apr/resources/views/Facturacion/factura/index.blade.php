@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center"> Listado de facturas pendientes de pago</h3>
        </div>
    
        <div class="card-body">
            <table class="table table-striped table-condensed">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Numero de medidor</th>
                        <th scope="col">Tipo de subsidio</th>
                        <th scope="col">total</th>
                        <th scope="col">deuda</th>
                        <th scope="col">fecha de factura</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @for($d=0; $d<$limite; $d++)
                        <tr>
                            <td>{{$d+1}}</td>
                            <td>{{$datos[$d]['direccion']}}</td>
                            <td>{{$datos[$d]['numeromedidor']}}</td>
                            <td>{{$datos[$d]['tipodesubsidio']}}</td>
                            <td>{{$datos[$d]['totalcobrado']}}</td>
                            <td>{{$datos[$d]['deuda']}}</td>
                            <td>{{$datos[$d]['fecha']}}</td>
                            <td>
                                <a href="{{route('factura.pagar', ['id' => $datos[$d]['idfactura']])}}"><button class="btn btn-info">pagar</button></a>
                            </td>
                        </tr>
                    @endfor
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
       $("#reportesopcionabrircerrar").removeClass("menu-open");
    $("#administracionopcionabrircerrar").removeClass("menu-open");
//agregamos el active de la seccion
  $("#menufacturacion").addClass("active");
});
</script>
@endpush