<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Vivienda;
use App\Http\Requests\viviendaFormRequest;
use DB;

class ViviendaController extends Controller
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
            $viviendas=  DB::table('vivienda')
            ->join('subsidio', 'vivienda.idsubsidio', '=', 'subsidio.idsubsidio')
            ->select('vivienda.*', 'subsidio.tipodesubsidio')
            ->where('vivienda.direccion','LIKE','%'.$query.'%')
            ->where('vivienda.estado','=','activo')
            ->orderBy('idvivienda','desc')
            ->paginate(3);
          
            return view('Administracion.vivienda.index',["viviendas"=>$viviendas,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
    	$subsidios=  DB::table('subsidio')->where('estado','=','activo')->get();
        return view("Administracion.vivienda.create",["subsidios"=>$subsidios]);
    }// para crear un objeto del modelo

    public function store(viviendaFormRequest $request){
        $vivienda = new Vivienda;
        $vivienda->idsubsidio=$request->get('idsubsidio');
        $vivienda->direccion=$request->get('direccion');
        $vivienda->numeromedidor=$request->get('numeromedidor');
        $vivienda->estado='activo';
        $vivienda->save();// recordar manejar save
        return Redirect::to("/vivienda");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
         $vivienda =vivienda::findOrFail($id);
         $subsidios=  DB::table('subsidio')->where('estado','=','activo')->get();
         return view("Administracion.vivienda.edit",["subsidios"=>$subsidios,"vivienda"=>$vivienda]);
    }//para editar 
    public function update(viviendaFormRequest $request, $id){
        $vivienda =vivienda::findOrFail($id);
        $vivienda->idsubsidio=$request->get('idsubsidio');
        $vivienda->direccion=$request->get('direccion');
        //revisar que el numero de medidor sea unico y no repetido
        if(DB::table('vivienda')->where('numeromedidor','LIKE',$request->get('numeromedidor'))->get()){
        	//error
        	// return errores
        }else{
       		 $vivienda->numeromedidor=$request->get('numeromedidor');
       		 $vivienda->update();// recordar manejar save
        }
        //fin de revivision
       
  
       
      return Redirect::to("/vivienda");

    }// para actualizar
    public function destroy($id){
                    $vivienda=vivienda::findOrFail($id);
                    $vivienda->estado='inactivo';
                    $vivienda->update();
 			return Redirect::to("/vivienda");

    }// para borrar
}
