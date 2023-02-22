@extends('layouts/Coffeemaker')
@section('css')
@endsection




@section('body')
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="w-full max-w-md p-8 bg-yellow-100 rounded-md">
            <div class="flex items-center justify-center text-6xl">
                <div class="pr-8"><i class="bi bi-emoji-frown  ml-6"></i></div>
                <div><h3 class="text-lg font-medium text-yellow-800">
                    Faltan algunas configuraciones por completar.
                </h3></div>
                
                
            </div>
            <div class="text-sm text-yellow-700">
                <p>
                    Por favor, complete las siguientes configuraciones antes de continuar:
                </p>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($config_fantantes as $config)
                    <li class="mb-2">
                        <a  href="{{ $config['url'] }}">{{ $config['mensaje'] }}</a>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
