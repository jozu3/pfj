@extends('adminlte::page')

@section('title', 'Locales')

@section('content_header')
    <a href="{{ route('admin.edificios.create') }}" class="btn btn-success btn-sm float-right">Nuevo Edificio</a>
    <h1>Administrar local</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            {!! Form::model($locale, ['route' => ['admin.locales.update', $locale], 'method' => 'put']) !!}
            @include('admin.locales.partials.form')
            {!! Form::submit('Editar local', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @livewire('admin.locale-edificios', ['locale' => $locale])
@stop

@section('css')
    <style type="text/css">
        .card-body {
            overflow: auto;
        }
    </style>
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
