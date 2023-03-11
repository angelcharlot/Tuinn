<?php

namespace App\Http\Controllers;

use App\Models\caja;
use App\Models\negocio;
use Illuminate\Http\Request;
use Cookie;

class caja_error extends Controller
{
    public function index()
    {
        $negocio = negocio::find(auth()->user()->negocio->id);
        $cajas = $negocio->cajas;
        if ($cajas->isEmpty()) {
            // Si no hay cajas registradas, crear una nueva caja
            $caja = new Caja();
            $caja->nombre = 'caja-1';
            $caja->saldo_actual = 0;
            $negocio->cajas()->save($caja);


            // Se crea la cookie 'caja' con el nombre de la caja creada
            $cookie = cookie('caja', $caja->nombre, 60 * 24 * 356 *5); // La cookie dura 30 días

            // Se redirecciona a la ruta "ventas.index" con la cookie creada
            return redirect()->route('ventas.index')
                ->withCookie($cookie);
        } else {
            return view('error_de_caja', compact('cajas'));

        }


    }
    public function store()
    {
        $negocio = Negocio::find(auth()->user()->negocio->id);

        // Contar el número de cajas existentes y sumar 1
        $numero_caja = 'caja-' . (count($negocio->cajas) + 1);

        // Crear la nueva caja
        $caja = new Caja();
        $caja->nombre = $numero_caja;
        $caja->negocio_id = $negocio->id;
        $caja->saldo_actual = 0;
        $caja->save();

        return redirect()->route('ventas.index')
            ->with('caja', $caja->nombre)
            ->with('caso', 2)
            ->withCookie(cookie('caja', $caja->nombre, 60 * 24 * 354* 5)); // Cookie dura 30 días
    }
    public function createcookin(Request $request)
    {
        $caja_id = $request->input('caja_existente');
        $caja = Caja::findOrFail($caja_id);
        $cookie = cookie('caja', $caja->nombre, 60 * 24 * 354 *5); // crea una cookie con el nombre de la caja

        return redirect()->route('ventas.index')
            ->with('caja', $caja->nombre)
            ->with('caso', 2)
            ->withCookie($cookie);
    }
}