@extends('layouts/Coffeemaker')
@section('css')
<link rel="stylesheet" href="{{asset('css/boton_file.css')}}">
@endsection
@section('body')
        		@livewire('productos.productos')
@endsection
