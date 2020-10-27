<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValorM3Controller;
use App\Http\Controllers\SubsidioController;
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
      return Redirect::to("/valorm3");
});

// valor por metro cubico
//Route::resource('/valorm3', Valorm3Controller::class);
Route::get('/valorm3', [Valorm3Controller::class,'index'])->name('valor.index');
Route::get('/valorm3/create', [Valorm3Controller::class,'create'])->name('valor.create');
Route::post('/valorm3', [Valorm3Controller::class,'store'])->name('valor.store');
Route::delete('/valorm3/{id}', [Valorm3Controller::class,'destroy'])->name('valor.destroy');
Route::get('/valorm3/{id}/edit', [Valorm3Controller::class,'edit'])->name('valor.edit');
Route::put('/valorm3/{id}', [Valorm3Controller::class,'update'])->name('valor.update');
// rutas de subsidio
Route::get('/subsidio', [SubsidioController::class,'index'])->name('subsidio.index');
Route::get('/subsidio/create', [SubsidioController::class,'create'])->name('subsidio.create');
Route::post('/subsidio', [SubsidioController::class,'store'])->name('subsidio.store');
Route::delete('/subsidio/{id}', [SubsidioController::class,'destroy'])->name('subsidio.destroy');
Route::get('/subsidio/{id}/edit', [SubsidioController::class,'edit'])->name('subsidio.edit');
Route::put('/subsidio/{id}', [SubsidioController::class,'update'])->name('subsidio.update');





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
