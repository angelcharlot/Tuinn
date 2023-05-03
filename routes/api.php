<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users', 'App\\Http\\Controllers\\apiuser@index');
Route::post('/mesas', 'App\\Http\\Controllers\\apiuser@mesas');
Route::post('/comanda', 'App\\Http\\Controllers\\apiuser@comanda');
Route::post('/areas', 'App\\Http\\Controllers\\apiuser@areas');
Route::post('/prueba', 'App\\Http\\Controllers\\apiuser@prueba');
Route::post('/comandar', 'App\\Http\\Controllers\\apiuser@comandar');
Route::post('/detalle', 'App\\Http\\Controllers\\apiuser@detalle');
Route::post('/imprimir_tiket', 'App\\Http\\Controllers\\apiuser@imprimir_tiket');
Route::post('/cobrar', 'App\\Http\\Controllers\\apiuser@cobrar');
Route::get('/whatsapp/incoming', 'App\\Http\\Controllers\\WhatsAppController@handleIncomingMessage');
Route::post('/whatsapp/incoming', 'App\\Http\\Controllers\\WhatsAppController@recibir_mensajes');

