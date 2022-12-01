
@extends('layouts/menu')
@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css') }}">
@endsection
@section('body')
<div class="tpl-snow w-full">
    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
</div>
@livewire('menu.menu',['id_negocio' => $id_negocio])
@endsection
@push('js')
<script src="{{ asset('js/menu.js') }}"></script>
@endpush


