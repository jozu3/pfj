@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <h1>Editar personal</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
    	<div class="card-body">
    		{!! Form::model($personale, ['route' => ['admin.personales.update', $personale], 'method' => 'put']) !!}
    			@include('admin.personales.partials.form')
                
                {!! Form::submit('Guardar', ['class' => 'btn btn-yellow-pfj']) !!}
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