@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
    <h1>Crear usuario</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @if (isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endif
    <div class="card">
    	<dic class="card-body">
    		{!! Form::open(['route' => 'admin.users.store']) !!}
                @if (isset($personal))
                <input type="hidden" name="personal_id" value="{{ $personal }}">
                @endif
                <input type="hidden" name="estado" value="1">
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmar password:') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                {!! Form::submit('Crear Usuario', ['class' => 'btn btn-primary']) !!}

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