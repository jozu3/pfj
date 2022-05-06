@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <h1>Contacto</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    
    @livewire('admin.contactos-index')
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop