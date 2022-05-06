@extends('adminlte::page')

@section('title', 'Inscripcioner')

@section('plugins.Select2', true)

@section('content_header')
    <h1>Registrar personal en sesión</h1>
@stop

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="card">
    	<div class="card-body">
    		{!! Form::model($contacto, ['route' => 'admin.inscripciones.store']) !!}
                @include('admin.inscripciones.partials.form')
                @include('admin.personales.partials.form')
                {!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
    		{!! Form::close() !!}
    	</div>
    </div>
@stop

@section('css')
    <style>
        .form-check{
            display: inline-block;
        }
    </style>
@stop

@section('js')
    <script> 
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@stop