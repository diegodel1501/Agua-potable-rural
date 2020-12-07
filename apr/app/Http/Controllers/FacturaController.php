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
    public function index(Request $request){
        
        if($request){
            $query=trim($request->get('searchText'));
            $viviendas=  DB::table('vivienda')
            ->join('subsidio', 'vivienda.idsubsidio', '=', 'subsidio.idsubsidio')
            ->select('vivienda.*', 'subsidio.tipodesubsidio')
            ->where('vivienda.direccion','LIKE','%'.$query.'%')
            ->where('vivienda.estado','=','activo')
            ->orderBy('idvivienda','desc')
            ->get();
        }
        return view('Facturacion.factura.index',["viviendas"=>$viviendas,"searchText"=>$query]);
        
    }
}
