<?php

use SimpleSoftwareIO\QrCode\Facades\QrCode ;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App\Models\productos;
use App\Models\idioma;
use App\Models\negocio;
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

Route::get('prueba/', function () {

    
   $negocio=negocio::find(auth()->user()->negocio->id);
    $negocio->interface='//localhost/TM-T88V';
   //$negocio->interface='prueba';
    $negocio->tipo_imp='epson';
   $negocio->productos;
   $negocio->usuario=$negocio->usuarios->first();
    
  
   $encodedData=$negocio->toJson();

    //dd($encodedData);

    $cliente = curl_init();
	curl_setopt($cliente, CURLOPT_URL, "http://185.141.222.250:8080/");
	curl_setopt($cliente, CURLOPT_HEADER, 0);
    curl_setopt($cliente, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cliente, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($cliente, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json'
    ));
    curl_setopt($cliente, CURLOPT_POST, true);
    curl_setopt($cliente, CURLOPT_POSTFIELDS, $encodedData);
	$respuesta=curl_exec($cliente);
   // print_r($respuesta);
	curl_close($cliente);


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

/*rutas protegidas por auth
/////////////////////////////////////////////////////////////////////////////////*/
Route::middleware(['auth:sanctum', 'verified'])->group(function(){



    Route::get('/dashboard', function () {
    return view('dashboard');
    })->name('dashboard');

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
        })->middleware('aut_negocio')->name('ventas.index');




});

