<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Http\Requests\viviendaFormRequest;
use DB;
use Symfony\Component\VarDumper\VarDumper;

class FacturaController extends Controller
{
    public function index(){
            $datos=  DB::table('vivienda as v')
            ->join('subsidio as s', 'v.idsubsidio', '=', 's.idsubsidio')
            ->join('factura as f','f.idvivienda','=','v.idvivienda')
            ->select('v.*', 's.tipodesubsidio','f.totalcobrado','f.fecha','f.idfactura')
            ->where('v.estado','=','activo')
            ->where('f.estado','=','activo')
            ->where('f.estadodepago','=','inpago')
            ->orderBy('idvivienda','desc')
            ->get();
        return view('Facturacion.factura.index',["datos"=>$datos]);
        
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
        return view('Facturacion.factura.pagarfactura',["factura"=>$factura,"vivienda"=>$vivienda]);

    }
    public function ingresarpago( Request $request){
        // crear pago y registrar saldo a favor o en contra ademas, quitar la factura de la lista de inpagas
            return $request->all();

    }
}
