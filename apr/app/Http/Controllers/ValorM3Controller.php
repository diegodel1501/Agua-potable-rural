<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\valorm3;
use App\Http\Requests\valorm3FormRequest;
use DB;
class ValorM3Controller extends Controller
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
            $valores=  DB::table('valorm3')->where('nombre','LIKE','%'.$query.'%')->where('estado','=','activo')->orderBy('idValorM3','desc')->paginate(3);
          
            return view('Administracion.valorm3.index',["valores"=>$valores,"searchText"=>$query]);
            }
    }// para mostrar la pagina inicial 
    public function create(){
        return view("Administracion.valorm3.create");
    }// para crear un objeto del modelo

    public function store(valorm3FormRequest $request){
        $valorm3 = new valorm3;
        $valorm3->nombre=$request->get('nombre');
        $valorm3->descripcion=$request->get('descripcion');
        $valorm3->precio=$request->get('precio');
        $valorm3->estado='activo';
        $valorm3->save();// recordar manejar save
        return Redirect::to("/valorm3");
    }//para guardar un objeto en la bd
   
    public function show($id){


    }//para mostrar
    public function edit($id){
         $valorm3 =valorm3::findOrFail($id);
         return view("Administracion.valorm3.edit",["valorm3"=>$valorm3]);
    }//para editar 
    public function update(valorm3FormRequest $request, $id){
        $valorm3 =valorm3::findOrFail($id);
        $valorm3->nombre=$request->get('nombre');
        $valorm3->descripcion=$request->get('descripcion');
        $valorm3->precio=$request->get('precio');
        $valorm3->update();// recordar manejar save
       
      return Redirect::to("/valorm3");

    }// para actualizar
    public function destroy($id){
                    $valorm3=valorm3::findOrFail($id);
                    $valorm3->estado='inactivo';
                    $valorm3->update();
 return Redirect::to("/valorm3");

    }// para borrar
}
