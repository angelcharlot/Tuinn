@extends('layouts/Coffeemaker')
@section('body')

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('configuraciones') }}
        </h2>
    </x-slot>

    <div>
        <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <x-jet-section-border />

            @can('config.negocio')
            <div class="mt-10 sm:mt-0">
                @livewire('local.local')
            </div>
            <x-jet-section-border />
            <div class="mt-10 sm:mt-0">
                @livewire('config')
            </div>

            @endcan
            <x-jet-section-border />
            
            {{--             <x-jet-section-border />
            <div class="mt-10 sm:mt-0">
                @livewire('personal')
            </div> --}}

        </div>
    </div>

@endsection
