@extends('layouts/Coffeemaker')
@section('css')
@endsection
@section('body')
    <div class="max-w-xl p-8 mx-auto bg-white rounded-lg shadow-md mt-7">
        <div class="p-4 mb-5 text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500" role="alert">
            <div class="flex">
                <div class="py-1"><i class="fas fa-exclamation-triangle fa-2x"></i></div>
                <div class="ml-4">
                    <h2 class="mb-2 text-lg font-bold">¡Ups!</h2>
                    <p class="text-base">No se pudo reconocer la caja que estás utilizando.</p>
                    <p class="text-base">Por favor, selecciona una caja existente o crea una nueva.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
            <div class="p-8 bg-gray-100 rounded-lg">
                <h2 class="mb-4 text-xl font-bold">Crear nueva caja</h2>
                <form action="{{ route('cajas.create') }}" method="post">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-700">
                        <i class="mr-2 bi bi-box-seam"></i>
                        Crear nueva caja
                    </button>
                </form>
            </div>

            <div class="p-8 bg-gray-100 rounded-lg">
                <h2 class="mb-4 text-xl font-bold">Seleccionar caja existente</h2>
                <form action="{{ route('cajas.cookin') }}" method="get">
                    <label for="caja_existente" class="sr-only">Seleccione una caja existente:</label>
                    <div class="relative mb-4">
                        <select name="caja_existente" id="caja_existente"
                            class="block w-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                            @foreach ($cajas as $caja)
                                <option value="{{ $caja->id }}">{{ $caja->nombre }} - Saldo actual:
                                    {{ $caja->saldo_actual }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                            <i class="bi bi-caret-down-fill"></i>
                        </div>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded cursor-pointer hover:bg-blue-700">
                        <i class="mr-2 bi bi-check2-circle"></i>
                        Seleccionar caja
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
