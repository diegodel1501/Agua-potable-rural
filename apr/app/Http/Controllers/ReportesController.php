<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Models\Factura;
use App\Models\Cupondepago;
use DB;
class ReportesController extends Controller{

    public function estadodecuentasgeneral(){
      // lista con las viviendas y el boton de ver 

        $viviendas=vivienda::where('estado','activo')->get();

        return view("Reportes.estadodecuentasgeneral", ["viviendas"=>$viviendas]);
    }
       public function historialdeconsumosgeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.historialdeconsumosgeneral", ["viviendas"=>$viviendas]);
    }
       public function estadisticasdeconsumogeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.estadisticasdeconsumogeneral", ["viviendas"=>$viviendas]);
    }
       public function reportesdepagogeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesdepagogeneral", ["viviendas"=>$viviendas]);
    }
       public function estadodecuentasparticular($idvivienda){
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.estadodecuentasparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
       public function historialdeconsumosparticular($idvivienda){
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.historialdeconsumosparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
      public function estadisticasdeconsumoparticular($idvivienda){
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.estadisticasdeconsumoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
       public function reportesdepagoparticular($idvivienda){
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.reportesdepagoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);

    }
     
}