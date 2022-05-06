@extends('adminlte::page')

@section('title', 'Crear personal')

@section('content_header')
    <h1>Crear personal</h1>
@stop

@section('content')
    <div class="card">
    	<div class="card-body">
    		{!! Form::open(['route' => 'admin.personales.store']) !!}
    			@include('admin.personales.partials.form')
                {!! Form::submit('Crear personal', ['class' => 'btn btn-primary']) !!}
    		{!! Form::close() !!}
    	</div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop