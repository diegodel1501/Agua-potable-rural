<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
      protected $table='factura';
   protected $primaryKey='idfactura';
   public $timestamps=false;

    protected $fillable=[
    	'idvivienda',
    	'estadodepago',
    	'totalcobrado',
    	'estado'
    ]; 
}
