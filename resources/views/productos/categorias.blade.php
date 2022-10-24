@extends('layouts/Coffeemaker')
@section('css')

@endsection
@section('body')
        		@livewire('categorias.categorias')
@endsection
@push('js')
<script src="{{ asset('js/categoria.js') }}"></script>
@endpush