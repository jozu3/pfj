@extends('adminlte::page')

@section('title', 'Anuncios')

@section('plugins.Sweetalert2', true)

@section('content_header')
    
<a href="{{ route('admin.anuncios.create') }}" class="btn btn-success btn-sm float-right">Nuevo anuncio</a>
<h1>Anuncios</h1>
    
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @forelse (auth()->user()->personale->inscripciones as $inscripcione)
    <div>
        @livewire('admin.anuncios-index', ['programa_id' => $inscripcione->programa->id], key($inscripcione->programa->id))
    </div>
    @empty
    <div>No está inscrito en ninguna sesión</div>
    @endforelse
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
    	
    </script>
@stop