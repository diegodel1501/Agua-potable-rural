<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\representante;
use App\Http\Requests\representanteFormRequest;
use DB;
class RepresentanteController extends Controller
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
            $representantes=  DB::table('representantedevivienda as r')
            ->join('vivienda as v', 'r.idvivienda', '=', 'v.idvivienda')
            ->select('r.*', 'v.direccion')
            ->where('r.nombre','LIKE','%'.$query.'%')
            ->where('r.estado','=','activo')
            ->orwhere('r.rut','LIKE','%'.$query.'%')
            ->where('r.estado','=','activo')
            ->orwhere('r.email','LIKE','%'.$query.'%')
            ->where('r.estado','=','activo')
            ->orwhere('v.direccion','LIKE','%'.$query.'%')
            ->where('r.estado','=','activo')
            ->orderBy('r.idvivienda','desc')
            ->paginate(3);
          
            return view('Administracion.representante.index',["representantes"=>$representantes,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
    	$viviendas=  DB::table('vivienda')->where('estado','=','activo')->get();
        return view("Administracion.representante.create",["viviendas"=>$viviendas]);
    }// para crear un objeto del modelo

    public function store(representanteFormRequest $request){
        $representante = new representante;
        $representante->idvivienda=$request->get('idvivienda');
        $representante->rut=$request->get('rut');
        $representante->nombre=$request->get('nombre');
        $representante->email=$request->get('email');
        $representante->telefono=$request->get('telefono');
        $representante->estado='activo';
        $representante->save();// recordar manejar save
        return Redirect::to("/representante");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
         $representante = DB::table('representantedevivienda as r')
            ->join('vivienda as v', 'r.idvivienda', '=', 'v.idvivienda')
            ->select('r.*', 'v.direccion')
            ->where('r.idrepresentante','=', $id)
            ->where('r.estado','=','activo')
            ->first();
         $viviendas=  DB::table('vivienda')->where('estado','=','activo')->get();
         return view("Administracion.representante.edit",["viviendas"=>$viviendas,"representante"=>$representante]);
    }//para editar 
    public function update(representanteFormRequest $request, $id){
        $representante =representante::findOrFail($id);
        $representante->idvivienda=$request->get('idvivienda');
        $representante->nombre=$request->get('nombre');
        $representante->rut=$request->get('rut');
        $representante->email=$request->get('email');
        $representante->telefono=$request->get('telefono');
        $representante->update();// recordar manejar save
  
       
      return Redirect::to("/representante");

    }// para actualizar
    public function destroy($id){
                    $representante=representante::findOrFail($id);
                    $representante->estado='inactivo';
                    $representante->update();
 			return Redirect::to("/representante");

    }// para borrar
}
