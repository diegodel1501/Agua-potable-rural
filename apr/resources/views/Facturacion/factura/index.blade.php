<link href="{{ asset('css/factura.css') }}" rel="stylesheet">
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
                        <th scope="col">monto a pagar</th>
                        <th scope="col">fecha de factura</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->direccion}}</td>
                            <td>{{$d->numeromedidor}}</td>
                            <td>{{$d->tipodesubsidio}}</td>
                            <td>{{$d->totalcobrado}}</td>
                            <td>{{$d->fecha}}</td>
                            <td>
                                <a href="{{route('factura.pagar', ['id' => $d->idfactura])}}"><button class="btn btn-info">pagar</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>


@endsection