<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Models\Factura;
use App\Models\representante;
use App\Models\Cupondepago;
use DB;
use Symfony\Component\VarDumper\VarDumper;

class ReportesController extends Controller{

    public function estadodecuentasgeneral(){
      // lista con las viviendas y el boton de ver 

        $viviendas=vivienda::where('estado','activo')->get();

        return view("Reportes.reportesgenerales.estadodecuentasgeneral", ["viviendas"=>$viviendas]);
    }
       public function historialdeconsumosgeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesgenerales.historialdeconsumosgeneral", ["viviendas"=>$viviendas]);
    }
       public function estadisticasdeconsumogeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesgenerales.estadisticasdeconsumogeneral", ["viviendas"=>$viviendas]);
    }
       public function reportesdepagogeneral(){
         $viviendas=vivienda::where('estado','activo')->get();
        return view("Reportes.reportesgenerales.reportesdepagogeneral", ["viviendas"=>$viviendas]);
    }
       public function estadodecuentasparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.reportesparticulares.estadodecuentasparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
       public function historialdeconsumosparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.reportesparticulares.historialdeconsumosparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
      public function estadisticasdeconsumoparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();

        return view("Reportes.reportesparticulares.estadisticasdeconsumoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
    }
       public function reportesdepagoparticular(){
        $email= Auth()->user()->email;
        $idvivienda = Representante::where('email',$email)->firstOrFail()->idvivienda;
        
        
        $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
        $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
        return view("Reportes.reportesparticulares.reportesdepagoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);

    }
    public function estadodecuentasparticularaa($idvivienda){
    
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      return view("Reportes.reportesparticulares.estadodecuentasparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
  }
     public function historialdeconsumosparticularaa($idvivienda){
    
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      return view("Reportes.reportesparticulares.historialdeconsumosparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
  }
    public function estadisticasdeconsumoparticularaa($idvivienda){
     
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();

      return view("Reportes.reportesparticulares.estadisticasdeconsumoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);
  }
     public function reportesdepagoparticularaa($idvivienda){
      
      
      $facturas=Factura::where('estado','activo')->where('idvivienda',$idvivienda)->get();
      $vivienda=Vivienda::where('idvivienda',$idvivienda)->first();
      return view("Reportes.reportesparticulares.reportesdepagoparticular", ["facturas"=>$facturas,"vivienda"=>$vivienda]);

  }
     
}