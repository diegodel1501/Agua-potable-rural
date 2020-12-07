<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Http\Requests\viviendaFormRequest;
use App\Http\Requests\CuponPFormRequest;
use App\Http\Requests\CuponEFormRequest;
use DB;
use Barryvdh\DomPDF\Facade as PDF;


class CupondepagoController extends Controller
{
	   public function __construct(){
//$this->middleware('auth');
//if(  Auth::user()->tipo_persona!='administrador'){
  //  if (Auth::user()->tipo_persona!='vendedor') {
    //     Redirect::to('errors.noaut')->send();
    //}
   //}
    }
    public function index(){
    		$fecha=explode(".",date("m.d.y"));
    		$fechaddmmaaaa=$fecha[1]."/".$fecha[0]."/".$fecha[2];
        return view('Facturacion.cupondepago.index',["fecha"=>$fechaddmmaaaa]);
        
    }

   	function ultimodiamesa() { 
      $month = date('m');
      $year = date('Y');
      $day = date("d", mktime(0,0,0, $month-1, 0, $year));
 
      return date('Y-m-d', mktime(0,0,0, $month-1, $day, $year));
  	}

  	function primerdiamesa() {
      $month = date('m');
      $year = date('Y');
      return date('Y-m-d', mktime(0,0,0, $month-1, 1, $year));
  	}
  	function ultimodiames() { 
      $month = date('m');
      $year = date('Y');
      $day = date("d", mktime(0,0,0, $month-1, 0, $year));
 
      return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
  	}

  	function primerdiames() {
      $month = date('m');
      $year = date('Y');
      return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
  	}

     public function generar(){
    		$fecha=explode(".",date("m.d.y"));
    		$fechaddmmaaaa=$fecha[1]."/".$fecha[0]."/".$fecha[2];

    		$listadeViviendas=DB::table('vivienda as V')
            ->join('representantedevivienda as R', 'V.idvivienda', '=', 'R.idvivienda')
             ->join('subsidio as S', 'S.idsubsidio', '=', 'V.idsubsidio')
             ->select('R.nombre', 'V.direccion', 'V.idvivienda', 'S.porcentajededescuento')
            // ->where('v.direccion','LIKE','%'.$query.'%')
            // ->where('m.estado','=','activo')
            // ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
             ->where('V.estado','=','activo')
             ->where('R.estado','=','activo')
             ->where('S.estado','=','activo')
             ->orderBy('V.idvivienda','desc')
            ->get();

            $lecturasanteriores=DB::table('vivienda as V')
            ->join('medicion as M', 'V.idvivienda', '=', 'M.idvivienda')
            // ->join('medicion as M', 'M.idvivienda', '=', 'V.idvivienda')
             ->select('M.valordemedicion', 'M.fechadeingreso', 'M.idvivienda' )
            // ->where('v.direccion','LIKE','%'.$query.'%')
            // ->where('m.estado','=','activo')
            // ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
             ->where('V.estado','=','activo')
             ->where('M.estado','=','activo')
             //descontar un mes de la fecha actual para ver las mediciones 
            ->wherebetween('M.fechadeingreso',[$this->primerdiamesa(),$this->ultimodiamesa()])
             ->orderBy('V.idvivienda','desc')
            ->get();

             $lecturasactuales=DB::table('vivienda as V')
            ->join('medicion as M', 'M.idvivienda', '=', 'V.idvivienda')
            // ->join('medicion as M', 'M.idvivienda', '=', 'V.idvivienda')
             ->select('M.valordemedicion', 'M.fechadeingreso', 'M.idvivienda' )
            // ->where('v.direccion','LIKE','%'.$query.'%')
            // ->where('m.estado','=','activo')
            // ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
             ->where('V.estado','=','activo')
             ->where('M.estado','=','activo')
             //descontar un mes de la fecha actual para ver las mediciones 
            ->wherebetween('M.fechadeingreso',[$this->primerdiames(),$this->ultimodiames()])
            ->orderBy('V.idvivienda','desc')
            ->get();

            $valorm3=DB::table("valorm3")->select("precio")->where("estado","=","activo")->get();

           $listaconinformacioncompleta[]=count($listadeViviendas);
           $cuenta=count($listadeViviendas);
           for ($i=0; $i <$cuenta ; $i++) { 
           		//pregunto por el id vivienda para asignar medicion anterior si es que existe
           	if((int)($listadeViviendas[$i]->idvivienda)==$lecturasanteriores[$i]->idvivienda){
           			if((int)($listadeViviendas[$i]->idvivienda)==$lecturasactuales[$i]->idvivienda){
           				 $saldo=DB::table('saldodiferenciado')
           				 ->select('tipo','monto')
           				 ->where('idvivienda','=',$listadeViviendas[$i]->idvivienda)
           				 ->where('estado','=','activo')
           				 ->get();
           				 if(count($saldo)>1){
           				 	return "error problema en el saldo de la vivienda ".$listadeViviendas[$i]->direccion.", por favor regularizar antes de generar cupones, recuerde que no deben haber mas de 1 saldo inconcluso por vivienda.";
           				 }
           				 $multa=0;
           				 if(!$saldo->first()){
           				 	$multa=0;
           				 }else{
           				 	if($saldo->tipo='haber'){
           				 		$multa=(int)$saldo->monto;
           				 	}else{
           				 		$multa=0-(int)$saldo->monto;
           				 	}
           				 }
           			
           				$listaconinformacioncompleta[$i]=
           				array(
           					'nombre' =>$listadeViviendas[$i]->nombre, 
           					'direccion'=>$listadeViviendas[$i]->direccion,
           					 'lecturaanterior'=>$lecturasanteriores[$i]->valordemedicion,
           					 'subsidio' =>$listadeViviendas[$i]->porcentajededescuento.'%',
           					 'lecturaactual'=>$lecturasactuales[$i]->valordemedicion,
           					 'valorm3'=>$valorm3->first()->precio,
           					 'totaldelmes'=>
           					 (((int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion))
           					 *(int)($valorm3->first()->precio)),
           					 'm3'=>(int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion),
           					 'multa'=> $multa,
           					 'totalfinal'=>(((int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion))
           					 *(int)($valorm3->first()->precio))-
           					 ((((int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion))
           					 *(int)($valorm3->first()->precio))*((int)($listadeViviendas[$i]->porcentajededescuento)/100))+$multa
           					);
           			}else{
           				return "error no tenemos datos de medicion de este mes en la vivienda:".$listadeViviendas[$i]->direccion.", por favor regularizar antes de generar cupones.";
           			}	  	
           	}else{

           		return "error no tenemos datos de medicion del mes pasado en la vivienda:".$listadeViviendas[$i]->direccion.", por favor regularizar antes de generar cupones.";

           	}
         
        
           }
        return view('Facturacion.cupondepago.cupondepagoformat',["fecha"=>$fechaddmmaaaa,"lista"=>$listaconinformacioncompleta,'final'=>$cuenta]);
        
    }
    public function generarparticular(){
    	$fecha=explode(".",date("m.d.y"));
    	$fechaddmmaaaa=$fecha[1]."/".$fecha[0]."/".$fecha[2];
    	$viviendas=DB::table('vivienda')
    	->select('direccion','idvivienda')
    	->where('estado','=','activo')
    	->orderBy('idvivienda','desc')
    	->get();
    	return view('Facturacion.cupondepago.cupondepagounitario',["fecha"=>$fechaddmmaaaa,"viviendas"=>$viviendas]);
        
    }
    public function mostrarparticular(CuponPFormRequest $request){
    	$fecha=explode(".",date("m.d.y"));
    	$fechaddmmaaaa=$fecha[1]."/".$fecha[0]."/".$fecha[2];
    	$idsubsidio=DB::table('vivienda')->select('idsubsidio')->where('idvivienda','=',$request->get('vivienda'))->first()->idsubsidio;
    	$nombre=DB::table('representantedevivienda')
    	->select('nombre')
    	->where('estado','=','activo')
    	->where('idvivienda','=',$request->get('vivienda'))
    	->first()->nombre;
    	$direccion=DB::table('vivienda')
    	->select('direccion')
    	->where('estado','=','activo')
    	->where('idvivienda','=',$request->get('vivienda'))
    	->first()->direccion;
    	$lecturaanterior=DB::table('medicion')
    	->select('valordemedicion')
    	->where('estado','=','activo')
    	->where('idvivienda','=',$request->get('vivienda'))
    	->wherebetween('fechadeingreso',[$this->primerdiamesa(),$this->ultimodiamesa()])
    	->first()->valordemedicion;
    	$lecturaactual=DB::table('medicion')
    	->select('valordemedicion')
    	->where('estado','=','activo')
    	->where('idvivienda','=',$request->get('vivienda'))
    	->wherebetween('fechadeingreso',[$this->primerdiames(),$this->ultimodiames()])
    	->first()->valordemedicion;
    	$valorm3=DB::table('valorm3')->select('precio')->where('estado','=','activo')->first()->precio;
    	$totaldelmes=((int)$lecturaactual-(int)$lecturaanterior)*(int)$valorm3;
    	$saldo=DB::table('saldodiferenciado')
           				 ->select('tipo','monto')
           				 ->where('idvivienda','=',$request->get('vivienda'))
           				 ->where('estado','=','activo')
           				 ->get();
           				 if(count($saldo)>1){
           				 	return "error problema en el saldo de la vivienda ".$direccion.", por favor regularizar antes de generar cupones, recuerde que no deben haber mas de 1 saldo inconcluso por vivienda.";
           				 }
           				 $multa=0;
           				 if(!$saldo->first()){
           				 	$multa=0;
           				 }else{
           				 	if($saldo->tipo='haber'){
           				 		$multa=(int)$saldo->monto;
           				 	}else{
           				 		$multa=0-(int)$saldo->monto;
           				 	}
           				 }
         $m3=(int)$lecturaactual-(int)$lecturaanterior;
         $descuento=DB::table('subsidio')
         ->select('porcentajededescuento')
         ->where('estado','=','activo')
         ->where('idsubsidio','=',$idsubsidio)
         ->first()->porcentajededescuento;
         $totalfinal=(int)$totaldelmes-((int)$totaldelmes*(int)$descuento/100);
         return view('Facturacion.cupondepago.cuponunitario',["fecha"=>$fechaddmmaaaa,"nombre"=>$nombre,"direccion"=>$direccion,"lecturaanterior"=>$lecturaanterior,"lecturaactual"=>$lecturaactual,"valorm3"=>$valorm3,"totaldelmes"=>$totaldelmes,"multa"=>$multa,"m3"=>$m3,"subsidio"=>$descuento,"totalfinal"=>$totalfinal]);
    }
    public function exportarparticular(CuponEformRequest $request){
    	$pdf=PDF::loadview('Facturacion.cupondepago.exportarunitario',[
    		"fecha"=>$request->get('fecha'),
    		"nombre"=>$request->get('nombre'),
    		"direccion"=>$request->get('direccion'),
    		"lecturaanterior"=>$request->get('lecturaanterior'),
    		"lecturaactual"=>$request->get('lecturaactual'),
    		"valorm3"=>$request->get('valorm3'),
    		"totaldelmes"=>$request->get('totaldelmes'),
    		"multa"=>$request->get('multa'),
        "m3"=>$request->get('m3'),
         "mesanterior"=>'0',
    		"subsidio"=>$request->get('subsidio'),
    		"totalfinal"=>$request->get('totalfinal')
    	]);
    	return $pdf->download('Cupondepago-'.$request->get('direccion').'.pdf');
    }
    public function exportartodos(){
      $fecha=explode(".",date("m.d.y"));
        $fechaddmmaaaa=$fecha[1]."/".$fecha[0]."/".$fecha[2];

        $listadeViviendas=DB::table('vivienda as V')
            ->join('representantedevivienda as R', 'V.idvivienda', '=', 'R.idvivienda')
             ->join('subsidio as S', 'S.idsubsidio', '=', 'V.idsubsidio')
             ->select('R.nombre', 'V.direccion', 'V.idvivienda', 'S.porcentajededescuento')
            // ->where('v.direccion','LIKE','%'.$query.'%')
            // ->where('m.estado','=','activo')
            // ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
             ->where('V.estado','=','activo')
             ->where('R.estado','=','activo')
             ->where('S.estado','=','activo')
             ->orderBy('V.idvivienda','desc')
            ->get();

            $lecturasanteriores=DB::table('vivienda as V')
            ->join('medicion as M', 'V.idvivienda', '=', 'M.idvivienda')
            // ->join('medicion as M', 'M.idvivienda', '=', 'V.idvivienda')
             ->select('M.valordemedicion', 'M.fechadeingreso', 'M.idvivienda' )
            // ->where('v.direccion','LIKE','%'.$query.'%')
            // ->where('m.estado','=','activo')
            // ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
             ->where('V.estado','=','activo')
             ->where('M.estado','=','activo')
             //descontar un mes de la fecha actual para ver las mediciones 
            ->wherebetween('M.fechadeingreso',[$this->primerdiamesa(),$this->ultimodiamesa()])
             ->orderBy('V.idvivienda','desc')
            ->get();

             $lecturasactuales=DB::table('vivienda as V')
            ->join('medicion as M', 'M.idvivienda', '=', 'V.idvivienda')
            // ->join('medicion as M', 'M.idvivienda', '=', 'V.idvivienda')
             ->select('M.valordemedicion', 'M.fechadeingreso', 'M.idvivienda' )
            // ->where('v.direccion','LIKE','%'.$query.'%')
            // ->where('m.estado','=','activo')
            // ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
             ->where('V.estado','=','activo')
             ->where('M.estado','=','activo')
             //descontar un mes de la fecha actual para ver las mediciones 
            ->wherebetween('M.fechadeingreso',[$this->primerdiames(),$this->ultimodiames()])
            ->orderBy('V.idvivienda','desc')
            ->get();

            $valorm3=DB::table("valorm3")->select("precio")->where("estado","=","activo")->get();

           $listaconinformacioncompleta[]=count($listadeViviendas);
           $cuenta=count($listadeViviendas);
           for ($i=0; $i <$cuenta ; $i++) { 
              //pregunto por el id vivienda para asignar medicion anterior si es que existe
            if((int)($listadeViviendas[$i]->idvivienda)==$lecturasanteriores[$i]->idvivienda){
                if((int)($listadeViviendas[$i]->idvivienda)==$lecturasactuales[$i]->idvivienda){
                   $saldo=DB::table('saldodiferenciado')
                   ->select('tipo','monto')
                   ->where('idvivienda','=',$listadeViviendas[$i]->idvivienda)
                   ->where('estado','=','activo')
                   ->get();
                   if(count($saldo)>1){
                    return "error problema en el saldo de la vivienda ".$listadeViviendas[$i]->direccion.", por favor regularizar antes de generar cupones, recuerde que no deben haber mas de 1 saldo inconcluso por vivienda.";
                   }
                   $multa=0;
                   if(!$saldo->first()){
                    $multa=0;
                   }else{
                    if($saldo->tipo='haber'){
                      $multa=(int)$saldo->monto;
                    }else{
                      $multa=0-(int)$saldo->monto;
                    }
                   }
                
                  $listaconinformacioncompleta[$i]=
                  array(
                    'nombre' =>$listadeViviendas[$i]->nombre, 
                    'direccion'=>$listadeViviendas[$i]->direccion,
                     'lecturaanterior'=>$lecturasanteriores[$i]->valordemedicion,
                     'subsidio' =>$listadeViviendas[$i]->porcentajededescuento.'%',
                     'lecturaactual'=>$lecturasactuales[$i]->valordemedicion,
                     'valorm3'=>$valorm3->first()->precio,
                     'totaldelmes'=>
                     (((int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion))
                     *(int)($valorm3->first()->precio)),
                     'm3'=>(int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion),
                     'multa'=> $multa,
                     'mesanterior'=>'0',
                     'totalfinal'=>(((int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion))
                     *(int)($valorm3->first()->precio))-
                     ((((int)($lecturasactuales[$i]->valordemedicion)-(int)($lecturasanteriores[$i]->valordemedicion))
                     *(int)($valorm3->first()->precio))*((int)($listadeViviendas[$i]->porcentajededescuento)/100))+$multa
                    );
                }else{
                  return "error no tenemos datos de medicion de este mes en la vivienda:".$listadeViviendas[$i]->direccion.", por favor regularizar antes de generar cupones.";
                }     
            }else{

              return "error no tenemos datos de medicion del mes pasado en la vivienda:".$listadeViviendas[$i]->direccion.", por favor regularizar antes de generar cupones.";

            }
         
        
           }
           $pdf=PDF::loadview('Facturacion.cupondepago.exportartodos',[
            "fecha"=>$fechaddmmaaaa,
            "lista"=>$listaconinformacioncompleta,
            'final'=>$cuenta
           ]);
        return $pdf->download('CuponesDePago.pdf');
    }
}
