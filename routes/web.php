<?php

use Illuminate\Support\Facades\Route;

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

//errorer
Route::get('errors/401', function () {
    return view('errors/401');
})->name('error.401');

/////////////////////////////////////////////////////////////////


Route::get('/', function () {
    if (auth()->check()){
        return redirect()->to('dashboard');
    }
    return view('welcome');
});

/*rutas protegidas por auth*/
/////////////////////////////////////////////////////////////////////////////////
Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::get('/dashboard', function () {
    return view('dashboard');
    })->name('dashboard');
    Route::get('/negocio/index', function () {
    return view('negocio/index');
})->middleware('aut_negocio')->name('negocio.index');
    Route::get('/producto/index', function () {
    return view('producto/index');
})->middleware('aut_negocio')->name('producto.index');

});

    