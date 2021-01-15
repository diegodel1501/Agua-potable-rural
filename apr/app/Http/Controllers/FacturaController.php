<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Models\Pago;
use App\Models\Factura;
use App\Models\Saldodiferenciado;
use App\Http\Requests\viviendaFormRequest;
use DB;

use Symfony\Component\VarDumper\VarDumper;

class FacturaController extends Controller
{
    public function index(){
            $datos=  DB::table('vivienda as v')
            ->join('subsidio as s', 'v.idsubsidio', '=', 's.idsubsidio')
            ->join('factura as f','f.idvivienda','=','v.idvivienda')
            ->select('v.*','s.tipodesubsidio','f.totalcobrado','f.fecha','f.idfactura')
            ->where('v.estado','=','activo')
            ->where('f.estado','=','activo')
            ->where('f.estadodepago','<>','pagado')
            ->orderBy('idvivienda','desc')
            ->get();
            $datoscondeuda[]=count($datos);
                 for ($d=0; $d <count($datos) ; $d++) { 
                    $deuda=DB::table('saldodiferenciado')
                    ->select('monto','tipo')
                    ->where('idvivienda','=',$datos[$d]->idvivienda)
                    ->where('estado','=','activo')
                    ->first();
                         if($deuda){
                            if($deuda->tipo=="haber"){
                                         $datoscondeuda[$d]=array(
                                        'idfactura'=>$datos[$d]->idfactura,
                                        'direccion'=>$datos[$d]->direccion,
                                        'numeromedidor'=>$datos[$d]->numeromedidor,
                                        'tipodesubsidio'=>$datos[$d]->tipodesubsidio,
                                        'totalcobrado'=>$datos[$d]->totalcobrado,
                                        'deuda'=>(int)$datos[$d]->totalcobrado-(int)$deuda->monto,
                                        'fecha'=>$datos[$d]->fecha
                                                  ); 
                            }else{
                                       $datoscondeuda[$d]=array(
                                        'idfactura'=>$datos[$d]->idfactura,
                                        'direccion'=>$datos[$d]->direccion,
                                        'numeromedidor'=>$datos[$d]->numeromedidor,
                                        'tipodesubsidio'=>$datos[$d]->tipodesubsidio,
                                        'totalcobrado'=>$datos[$d]->totalcobrado,
                                        'deuda'=>$deuda->monto,
                                        'fecha'=>$datos[$d]->fecha
                                                  ); 
                            } 
                           
                        }else{
                                        $datoscondeuda[$d]=array(
                                        'idfactura'=>$datos[$d]->idfactura,
                                        'direccion'=>$datos[$d]->direccion,
                                        'numeromedidor'=>$datos[$d]->numeromedidor,
                                        'tipodesubsidio'=>$datos[$d]->tipodesubsidio,
                                        'totalcobrado'=>$datos[$d]->totalcobrado,
                                        'deuda'=>$datos[$d]->totalcobrado,
                                        'fecha'=>$datos[$d]->fecha
                                                  ); 
                        }
                     
                    
                 }
        return view('Facturacion.factura.index',["datos"=>$datoscondeuda,"limite"=>count($datos)]);
        
    }
    public function pagar($idfactura){
            $factura=DB::table('factura')
            ->select('totalcobrado','fecha','idvivienda','idfactura')
            ->where('idfactura','=',$idfactura)
            ->first();
            $vivienda=DB::table('vivienda')
            ->select('direccion')
            ->where('idvivienda','=',$factura->idvivienda)
            ->first();
            $deuda=DB::table('saldodiferenciado')
            ->select('monto','tipo')
            ->where('idvivienda','=',$factura->idvivienda)
            ->first();
            if($deuda){
                if($deuda->tipo=="deber"){
                $deber=$deuda->monto;                    
                }else{
// si es de tipo haber signifia que es un saldo anterior a favor y no un ciclo de deudas por lo que le descontamos el saldo a la facturacion  
                    $deber=$factura->totalcobrado-$deuda->monto;
                }
            }else{
                $deber=$factura->totalcobrado;
            }

        return view('Facturacion.factura.pagarfactura',["factura"=>$factura,"vivienda"=>$vivienda,"deuda"=>$deber]);

    }
    public function ingresarpago( Request $request){
        // crear pago y registrar saldo a favor o en contra ademas, quitar la factura de la lista de inpagas
        //montopagado,vivienda,factura
                $pago= new Pago;
                $pago->idfactura=$request->get('factura');
                $pago->fecha=date('Y-m-d');
                $pago->valorpagado=$request->get('montopagado');
                $pago->estado='activo';
                $factura=Factura::findOrFail($request->get('factura'));
                $saldodiferenciado=DB::table('saldodiferenciado')
                ->select('idsaldodiferenciado')
                ->where('idvivienda','=',$request->get('vivienda'))
                ->first();
                if($saldodiferenciado){
                 $saldodiferenciado=Saldodiferenciado::find($saldodiferenciado->idsaldodiferenciado);
                }
                if((int)$request->get('montopagado')==(int)$request->get('totalcobrado')){
                    // totalmente pagado
                    $factura->estadodepago='pagado';
                    $factura->update();
                    // quitar saldodiferenciado si es deber
                    if($saldodiferenciado->tipo=="deber"){
                        $saldodiferenciado->tipo=="haber";
                        $saldodiferenciado->monto='0';
                        $saldodiferenciado->update();
                    }// si es haber no se lo reseteamos, el total cobrado implica la deuda actual de la factura por lo que solo se podria pagar en caso de que aun deba, de tener dindero a su favor se vera en a siguiente factura

                }else{
                    if((int)$request->get('montopagado')<(int)$request->get('totalcobrado')){
                        //deber 
                        $factura->estadodepago='parcialmente';
                        $factura->update();
                          if($saldodiferenciado){
                                $saldodiferenciado->descripcion='deuda fecha:'.date('Y-m-d').'factura '.$factura->idfactura;
                                $saldodiferenciado->monto=(int)$request->get('totalcobrado')-(int)$request->get('montopagado');
                                $saldodiferenciado->tipo='deber';
                                $saldodiferenciado->estado='activo';
                                $saldodiferenciado->update();
                            }else{
                                $saldodiferenciado= new Saldodiferenciado;
                                $saldodiferenciado->descripcion='deuda fecha:'.date('Y-m-d').'factura '.$factura->idfactura;
                                $saldodiferenciado->monto=(int)$request->get('totalcobrado')-(int)$request->get('montopagado');
                                $saldodiferenciado->tipo='deber';
                                $saldodiferenciado->estado='activo';
                                $saldodiferenciado->idvivienda=$request->get('vivienda');
                                $saldodiferenciado->save();
                            }
                    }else{
                        //haber
                          $factura->estadodepago='pagado';
                          $factura->update();

                             if($saldodiferenciado){
                                $saldodiferenciado->descripcion='haber fecha:'.date('Y-m-d').'factura '.$factura->idfactura;
                                $saldodiferenciado->monto=(int)$request->get('montopagado')-(int)$request->get('totalcobrado');
                                $saldodiferenciado->tipo='haber';
                                $saldodiferenciado->estado='activo';
                                $saldodiferenciado->idvivienda=$request->get('vivienda');
                                $saldodiferenciado->update();
                            }else{
                                $saldodiferenciado= new Saldodiferenciado;
                                $saldodiferenciado->descripcion='haber fecha:'.date('Y-m-d').'factura '.$factura->idfactura;
                                $saldodiferenciado->monto=(int)$request->get('montopagado')-(int)$request->get('totalcobrado');
                                $saldodiferenciado->tipo='haber';
                                $saldodiferenciado->estado='activo';
                                $saldodiferenciado->idvivienda=$request->get('vivienda');
                                $saldodiferenciado->save();
                            }
                    }
                }
                $pago->save();
                return Redirect::to("/facturacion");


    }
}
