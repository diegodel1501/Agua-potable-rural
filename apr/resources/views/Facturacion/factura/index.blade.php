<link href="{{ asset('css/factura.css') }}" rel="stylesheet">
@extends('layouts.app')
@section('contenido')

    <div class="card">
        <div class="card-header">
            <h3 class="text-center"> Listado de Viviendas a facturar</h3>
        </div>
    
        <div class="card-body">
            <table class="table table-striped table-condensed">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Numero de medidor</th>
                        <th scope="col">Tipo de subsidio</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viviendas as $vivienda)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$vivienda->direccion}}</td>
                            <td>{{$vivienda->numeromedidor}}</td>
                            <td>{{$vivienda->tipodesubsidio}}</td>
                            <td>
                                <a href="#"><button class="btn btn-info">Facturar</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
    </div>


@endsection