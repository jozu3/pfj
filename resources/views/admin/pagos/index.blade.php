@extends('adminlte::page')

@section('title', 'Pagos')

@section('content_header')
    <a href="{{ route('admin.pagos.create') }}" class="btn btn-success btn-sm float-right">Registrar pago</a>
    <h1>Lista de pagos</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @php
        $search = '';
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        }
    @endphp
    @livewire('admin.pagos-index', ['search' => $search])
@stop

@section('css')
    <style>
        .w-auto{
            width:auto;
        }
    </style>   
@stop

@section('js')

    <script> console.log('Hi!'); </script>
@stop