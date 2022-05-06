@extends('adminlte::page')

@section('title', 'Pfjs')

@section('content_header')
    @can('admin.pfjs.create')
        <a href="{{ route('admin.pfjs.create') }}" class="btn btn-success btn-sm float-right">Nuevo pfj</a>
    @endcan
    <h1>Lista de pfjs</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
     @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @livewire('admin.pfjs-index')
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop