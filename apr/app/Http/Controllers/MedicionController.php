<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Medicion;
use App\Http\Requests\MedicionFormRequest;
use DB;
class MedicionController extends Controller
{
     public function validar($fecha){
    $valores = explode('/', $fecha);
    if(count($valores) == 3 && checkdate($valores[1], $valores[0], $valores[2])){
        return true;
    }
    return false;
}
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
            $mediciones=  DB::table('medicion as m')
            ->join('vivienda as v', 'm.idvivienda', '=', 'v.idvivienda')
            ->join('users as u', 'u.id', '=', 'm.idinscriptor')
            ->select('m.*', 'v.direccion', 'u.name as inscriptor')
            ->where('v.direccion','LIKE','%'.$query.'%')
            ->where('m.estado','=','activo')
            ->orwhere('m.fechadeingreso','LIKE','%'.$query.'%')
            ->where('m.estado','=','activo')
            ->orderBy('m.idmedicion','desc')
            ->paginate(3);
          
            return view('Administracion.medicion.index',["mediciones"=>$mediciones,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
    	$viviendas=  DB::table('vivienda')->where('estado','=','activo')->get();
        return view("Administracion.Medicion.create",["viviendas"=>$viviendas]);
    }// para crear un objeto del modelo

    public function store(MedicionFormRequest $request){
        $medicion = new Medicion;
        $medicion->idvivienda=$request->get('idvivienda');
        $medicion->idinscriptor=$request->get('idinscriptor');
        $medicion->valordemedicion=$request->get('valordemedicion');
       
        $medicion->fechadeingreso=date('Y-m-d');
        
        $medicion->estado='activo';
        $medicion->save();// recordar manejar save
        return Redirect::to("/medicion");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
        $Medicion=  DB::table('medicion as m')
            ->join('vivienda as v', 'm.idvivienda', '=', 'v.idvivienda')
            ->select('m.*', 'v.direccion')
            ->where('m.idmedicion','=',$id)
            ->where('m.estado','=','activo')
            ->first();
         $viviendas=DB::table('vivienda')->where('estado','=','activo')->get();
         return view("Administracion.Medicion.edit",["viviendas"=>$viviendas,"medicion"=>$Medicion]);
    }//para editar 
    public function update(Request $request, $id){
       
        $medicion =Medicion::findOrFail($id);
        if(is_numeric($request->get('valordemedicion'))){
         $medicion->valordemedicion=$request->get('valordemedicion'); 
        }else{
          $Medicion=  DB::table('medicion as m')
            ->join('vivienda as v', 'm.idvivienda', '=', 'v.idvivienda')
            ->select('m.*', 'v.direccion')
            ->where('m.idmedicion','=',$id)
            ->where('m.estado','=','activo')
            ->first();
         $viviendas=DB::table('vivienda')->where('estado','=','activo')->get();
         return view("Administracion.Medicion.edit",["viviendas"=>$viviendas,"medicion"=>$Medicion])->withErrors("wrong");
        }
       
        $medicion->update();// recordar manejar save
  
       
      return Redirect::to("/medicion");

    }// para actualizar
    public function destroy($id){
                    $Medicion=Medicion::findOrFail($id);
                    $Medicion->estado='inactivo';
                    $Medicion->update();
 			return Redirect::to("/medicion");

    }// para borrar
   
}
