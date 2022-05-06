@extends('adminlte::page')

@section('title', 'Editar profesor')

@section('content_header')
    <h1>Editar profesor</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <dic class="card-body">
            {!! Form::model($profesore, ['route' => ['admin.profesores.update', $profesore], 'method' => 'put']) !!}
                @include('admin.profesores.partials.form')
                {!! Form::submit('Guardar datos', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </dic>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>Grupos que enseña el profesor</h3>
        </div>
     @if ($grupos->count())
        <div class="card-body overflow-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pfj</th>
                        <th>Grupo</th>
                        <th>Estado</th>
                        <th>Unidades que enseña el profesor</th>
                        <th>Personales</th>
                        @can('admin.grupos.edit')
                        <th colspan="2"></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($grupos as $grupo)
                      <tr>
                        <td>{{ $grupo->nombre }}</td>
                        <td>{{ $grupo->fecha }}</td>
                        <td>
                            @if ( $grupo->estado == '0')
                                {{ 'Por iniciar' }}
                            @endif
                            @if ( $grupo->estado == '1')
                                {{ 'Iniciado' }}
                            @endif
                            @if ( $grupo->estado == '2')
                                {{ 'Terminado' }}
                            @endif
                        </td>
                        <td>
                                {{$profesore->gruposqueenseño($grupo->id)->count()}}
                        </td>
                        <td>
                            @if (!auth()->user()->hasRole('Profesor'))
                            {{ $grupo->inscripciones->count() }}
                            @endif
                        </td>
                        @can('admin.grupos.edit')
                        <td width="10px">
                            <a href="{{ route('admin.grupos.edit', $grupo) }}" class="btn btn-sm btn-primary" >Editar</a>
                        </td>
                        @endcan
                        @if (!Auth::user()->hasRole('Vendedor'))
                        <td width="10px">
                            <a href="{{ route('admin.grupos.show', $grupo) }}" class="btn btn-sm btn-primary" >Personales</a>
                        </td>
                        @endif
                        @can('admin.grupos.destroy')
                        <td width="10px">
                            <form method="POST" action="{{ route('admin.grupos.destroy', $grupo) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                        @endcan
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
        @else
            <div class="card-body">
                <b>No hay registros</b>        
            </div>
        @endif
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop