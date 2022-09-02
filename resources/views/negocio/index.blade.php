@extends('layouts/Coffeemaker')
@section('css')
@endsection
@section('body')
        		@livewire('personal')
@endsection
@push('js')
<script src="{{ asset('js/personal.js') }}"></script>
@endpush

