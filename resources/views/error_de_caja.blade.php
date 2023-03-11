@extends('layouts/Coffeemaker')
@section('css')
@endsection
@section('body')
<div class="flex flex-col items-center justify-center p-8 bg-red-500 border-2 border-white rounded-lg">
    <h1 class="mb-4 text-3xl font-bold text-white">Error de caja</h1>
    <p class="mb-4 text-lg text-white">No se pudo encontrar la caja especificada. Por favor, seleccione una caja existente o cree una nueva caja.</p>

    <div class="flex mb-4">
        <form class="mr-4" action=" {{ route('cajas.create') }} " method="post">
            @csrf
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-700">
                <i class="mr-2 bi bi-box-seam"></i>
                Crear nueva caja
            </button>
        </form>

        <form action=" {{ route('cajas.cookin') }}" method="get">
            <label for="caja_existente" class="sr-only">Seleccione una caja existente:</label>
            <div class="relative">
                <select name="caja_existente" id="caja_existente"
                    class="block w-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                    @foreach ($cajas as $caja)
                        <option value="{{ $caja->id }}">{{ $caja->nombre }} - Saldo actual:
                            {{ $caja->saldo_actual }}</option>
                    @endforeach
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                    <i class="bi bi-caret-down-fill"></i>
                </div>
            </div>
            <button type="submit" class="px-4 py-2 mt-5 font-bold text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-700">
                <i class="mr-2 bi bi-check2-circle"></i>
                Seleccionar caja
            </button>
        </form>
    </div>
</div>

@endsection
