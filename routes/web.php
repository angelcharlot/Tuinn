<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode ;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\productos;
use App\Models\idioma;
use App\Models\negocio;
use Illuminate\Http\Request;

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
//prueba

Route::get('prueba/', function (Request $request) {

    QrCode::size(400)->style('round')->format('png')->generate('https://www.tuinn.es/menu/'.$request->id, Storage::path('qr/'.$request->id.'.png'));


});

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

Route::get('/menu/{id?}', function ($id=1) {
    return view('menu/index')->with('id_negocio',$id);
});
Route::get('/configuraciones', 'App\Http\Controllers\ConfiguracionesIncompletasController@index')->name('configuraciones');
/*rutas protegidas por auth

/////////////////////////////////////////////////////////////////////////////////*/
Route::middleware(['auth:sanctum', 'verified'])->group(function(){

  
   
    Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware('aut_negocio','check-incomplete-configurations')->name('dashboard');

    Route::get('categorias/index', function () {
    return view('productos/categorias');
    })->middleware('aut_negocio')->name('categorias.index');


    Route::get('/negocio/index', function () {
    return view('negocio/index');
    })->middleware('aut_negocio')->name('negocio.index');

    Route::get('/productos/index', function () {
    return view('productos/index');
    })->middleware('aut_negocio')->name('productos.index');

    Route::get('/ventas', function () {
    return view('ventas/index');
    })->middleware('check-incomplete-configurations')->name('ventas.index');

    Route::get('/show2', function () {
    return view('profile.show2');
    })->name('profile.show2');

    Route::get('/mesas', function () {
    return view('areaymesa.index');
    })->name('areaymesa.index');

     Route::get('/impresoras', function () {
    return view('impresoras.index');
    })->name('impresoras.index');
 
    
    



});

