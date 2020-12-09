<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class HistorialDeConsumosController extends Controller{

    public function index(){
        return view('Reportes.historial_de_consumos.index');
    }
}