<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class ReportesController extends Controller{

    public function estadodecuentasgeneral(){

        return view("Reportes.estadodecuentasgeneral");
    }
       public function historialdeconsumosgeneral(){
        return view("Reportes.historialdeconsumosgeneral");
    }
       public function estadisticasdeconsumogeneral(){
        return view("Reportes.estadisticasdeconsumogeneral");
    }
       public function reportesdepagogeneral(){
        return view("Reportes.reportesdepagogeneral");
    }
       public function estadodecuentasparticular($id){
        return "estadodecuentasparticular";
    }
       public function historialdeconsumosparticular($id){
        return "historialdeconsumosparticular";
    }
      public function estadisticasdeconsumoparticular($id){
        return "estadisticasdeconsumoparticular";
    }
       public function reportesdepagoparticular($id){
        return "reportesdepagoparticular";
    }
     
}