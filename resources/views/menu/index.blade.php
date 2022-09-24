
@extends('layouts/menu')
@section('css')
@endsection
@section('body')
@livewire('menu.menu',['id_negocio' => $id_negocio])
@endsection
@push('js')
<script src="{{ asset('js/menu.js') }}"></script>
@endpush


