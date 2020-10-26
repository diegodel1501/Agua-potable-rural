<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValorM3Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('layouts/admin');
});


//Route::resource('/valorm3', Valorm3Controller::class);
Route::get('/valorm3', [Valorm3Controller::class,'index'])->name('valor.index');
Route::get('/valorm3/create', [Valorm3Controller::class,'create'])->name('valor.create');
Route::post('/valorm3', [Valorm3Controller::class,'store'])->name('valor.store');
Route::delete('/valorm3/{id}', [Valorm3Controller::class,'destroy'])->name('valor.destroy');
Route::get('/valorm3/{id}/edit', [Valorm3Controller::class,'edit'])->name('valor.edit');
Route::put('/valorm3/{id}', [Valorm3Controller::class,'update'])->name('valor.update');






Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
