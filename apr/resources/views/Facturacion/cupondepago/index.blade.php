@extends('layouts.app')
@section('contenido')
<link href="{{ asset('css/cupondepago.css') }}" rel="stylesheet">
<div class="row">
    <div class="card col-md-9 mx-auto">
        <div class="card-header">
            <h3 class="text-center">COMITE DE AGUA POTABLE RURAL <br>
                <b>"BULI ORIENTE"</b></h3>
        </div>
        <div class="card-body">
            <div class="form-inline float-right">
                <label class="form-label" for="date">Fecha de emisión: </label>
                <input class="from-control" id="date" type="date" disabled>
            </div>
            <div class="clearfix"></div>
                <div class="title">
                    <h2 class="text-center pt-2">Cupón de Pago</h4>
                </div>              

          
                <div class="">
                    <label class="form-label ml-4"for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-comtrol col-9" disabled >
            

                </div>
            
           
            <div class="row">
               <div class="col-md-9 mx-auto">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label class="form-label" for="prev">Lectura Anterior</label>
                            <input type="number" class="form-control"disabled>
                        </td>
                        <td>
                            <label class="form-label" for="today">Lectura Actual</label>
                            <input type="number" name="today" disabled class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="currentMonth" class="form-label">Total del Mes</label>
                            <input type="number" disabled class="form-control" name="currentMonth">
                        </td>
                        <td>
                            <label class="form-label" for="m3">M<sup>3</sup></label>
                            <input type="number" class="form-control" name="m3" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="currentMonthPrev" class="form-label">Mes Anterior</label>
                            <input type="number" disabled class="form-control" name="currentMonthPrev">
                        </td>
                        <td>
                            <label class ="form-label" for="benefit">Subsidio</label>
                            <input type="text" disabled name="benefit" class="form-control">
                
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="mulct" class="form-label">Multa</label>
                            <input type="text" class="form-control" disabled name="mulct">
                        </td>
                        <td>
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" name="total" disabled>
                        </td>
                    </tr>
                   
                </table>
                <span class="text-center">FECHA DE PAGO: Del 01 al 15 de cada mes.- HORARIO: 09:00-13:00</span>
                    
               </div>
            
            </div>
        </div>
    </div>

</div>
@endsection