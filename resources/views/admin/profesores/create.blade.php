@extends('adminlte::page')

@section('title', 'Crear profesor')

@section('content_header')
    <h1>Crear profesor</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
    	<dic class="card-body">
    		{!! Form::open(['route' => 'admin.profesores.store']) !!}
    			@include('admin.profesores.partials.form')
                {!! Form::submit('Crear profesor', ['class' => 'btn btn-primary']) !!}
    		{!! Form::close() !!}
    	</dic>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop