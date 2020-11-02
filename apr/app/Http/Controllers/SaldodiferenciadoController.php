<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Saldodiferenciado;
use App\Http\Requests\SaldodiferenciadoFormRequest;
use DB;
class SaldodiferenciadoController extends Controller
{
        public function __construct(){
//$this->middleware('auth');
//if(  Auth::user()->tipo_persona!='administrador'){
  //  if (Auth::user()->tipo_persona!='vendedor') {
    //     Redirect::to('errors.noaut')->send();
    //}
   //}
    }
     //la ruta resource maneja las siguientes funciones
    public function index(Request $request){
         
        if($request){
            $query=trim($request->get('searchText'));
            $saldodiferenciados=  DB::table('saldodiferenciado as s')
            ->join('vivienda as v', 's.idvivienda', '=', 'v.idvivienda')
            ->select('s.*', 'v.direccion')
            ->where('s.tipo','LIKE','%'.$query.'%')
            ->where('s.estado','=','activo')
            ->orwhere('s.descripcion','LIKE','%'.$query.'%')
            ->where('s.estado','=','activo')
            ->orwhere('v.direccion','LIKE','%'.$query.'%')
            ->where('s.estado','=','activo')
            ->orderBy('s.idsaldodiferenciado','desc')
            ->paginate(3);
          
            return view('Administracion.saldodiferenciado.index',["saldodiferenciados"=>$saldodiferenciados,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
    	$viviendas=  DB::table('vivienda')->where('estado','=','activo')->get();
        return view("Administracion.saldodiferenciado.create",["viviendas"=>$viviendas]);
    }// para crear un objeto del modelo

    public function store(SaldodiferenciadoFormRequest $request){
        $saldodiferenciado = new Saldodiferenciado;
        $saldodiferenciado->idvivienda=$request->get('idvivienda');
        $saldodiferenciado->tipo=$request->get('tipo');
        $saldodiferenciado->descripcion=$request->get('descripcion');
        $saldodiferenciado->monto=$request->get('monto');
        $saldodiferenciado->estado='activo';
        $saldodiferenciado->save();// recordar manejar save
        return Redirect::to("/saldodiferenciado");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
    	$saldodiferenciado=  DB::table('saldodiferenciado as s')
            ->join('vivienda as v', 's.idvivienda', '=', 'v.idvivienda')
            ->select('s.*', 'v.direccion')
            ->where('s.idsaldodiferenciado','=',$id)
            ->first();
         $viviendas=  DB::table('vivienda')->where('estado','=','activo')->get();
         return view("Administracion.saldodiferenciado.edit",["viviendas"=>$viviendas,"saldodiferenciado"=>$saldodiferenciado]);
    }//para editar 
    public function update(SaldodiferenciadoFormRequest $request, $id){
        $saldodiferenciado =Saldodiferenciado::findOrFail($id);
        $saldodiferenciado->idvivienda=$request->get('idvivienda');
        $saldodiferenciado->tipo=$request->get('tipo');
        $saldodiferenciado->descripcion=$request->get('descripcion');
        $saldodiferenciado->monto=$request->get('monto');
        $saldodiferenciado->update();// recordar manejar save
  
       
      return Redirect::to("/saldodiferenciado");

    }// para actualizar
    public function destroy($id){
                    $saldodiferenciado=Saldodiferenciado::findOrFail($id);
                    $saldodiferenciado->estado='inactivo';
                    $saldodiferenciado->update();
 			return Redirect::to("/saldodiferenciado");

    }// para borrar
}
