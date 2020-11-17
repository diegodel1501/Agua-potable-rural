<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class CupondepagoController extends Controller
{
    public function index(){


        return view('Facturacion.cupondepago.index');
        
    }
}
