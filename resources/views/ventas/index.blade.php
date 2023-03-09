@extends('layouts/menu')

@section('body')
    @livewire('venta', ['caja' => $caja,'caso' =>$caso])
@endsection


