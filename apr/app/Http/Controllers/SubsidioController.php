<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\subsidio;
use App\Http\Requests\subsidioFormRequest;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class SubsidioController extends Controller
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
            $subsidios=  DB::table('subsidio')->where('descripcion','LIKE','%'.$query.'%')->where('estado','=','activo')->orderBy('idsubsidio','desc')->get();
          
            return view('Administracion.subsidio.index',["subsidios"=>$subsidios,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
        return view("Administracion.subsidio.create");
    }// para crear un objeto del modelo

    public function store(subsidioFormRequest $request){
        $subsidio = new subsidio;
        $subsidio->porcentajededescuento=$request->get('porcentajededescuento');
        $subsidio->descripcion=$request->get('descripcion');
        $subsidio->tipodesubsidio=$request->get('tipodesubsidio');
        $subsidio->estado='activo';
        $subsidio->save();// recordar manejar save

        Alert::success('Buen Trabajo','Los datos se han registrado exitosamente');

        return Redirect::to("/subsidio");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
         $subsidio =subsidio::findOrFail($id);
         return view("Administracion.subsidio.edit",["subsidio"=>$subsidio]);
    }//para editar 
    public function update(subsidioFormRequest $request, $id){
        $subsidio =subsidio::findOrFail($id);
        $subsidio->tipodesubsidio=$request->get('tipodesubsidio');
        $subsidio->descripcion=$request->get('descripcion');
        $subsidio->porcentajededescuento=$request->get('porcentajededescuento');
        $subsidio->update();// recordar manejar save
      
        Alert::success('Buen Trabajo','Los datos se han actualizado exitosamente');

      return Redirect::to("/subsidio");

    }// para actualizar
    public function destroy($id){
                    $subsidio=subsidio::findOrFail($id);
                    $subsidio->estado='inactivo';
                    $subsidio->update();
      
      Alert::success('Los datos han sido eliminados');

 			return Redirect::to("/subsidio");

    }// para borrar
}
