@extends('layouts/menu')

@section('body')

@livewire('venta', [
    'caja' => session('caja'),
    'caso' => session('caso')
])
@endsection


