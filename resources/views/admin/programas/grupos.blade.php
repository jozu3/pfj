@extends('adminlte::page')

@section('title', 'Grupos ')

@section('content_header')
    <h1>Grupos por Sesión</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    @forelse (auth()->user()->personale->inscripciones as $inscripcione)
    <div>
        <div class="pgrupos">
            <nav class="navbar navbar-dark bg-yellow-pfj">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nombre-sesion" href="#">{{ $inscripcione->programa->nombre }}</a>
                @forelse ($inscripcione->programa->grupos as $grupo)
                <a class="nav-item nav-link" id="nav-home-tab{{ $grupo->id }}" data-toggle="tab" 
                    href="#nav-home{{ $grupo->id }}" role="tab" aria-controls="nav-home{{ $grupo->id }}" aria-selected="">{{ 'Grupo ' . $grupo->numero }}</a>
                @empty
                
                @endforelse
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @forelse ($inscripcione->programa->grupos as $grupo)
                <div class="tab-pane fade show" id="nav-home{{ $grupo->id }}" role="tabpanel" aria-labelledby="nav-home-tab{{ $grupo->id }}">
                   @livewire('admin.inscripcione-programa-index', ['grupo_id' => $grupo->id], key($grupo->id))
                  
                </div>
                @empty
                <div class="card">
                    <div class="card-header text-warning">
                        {{ 'No hay grupos' }}
                    </div>
                </div>
                @endforelse
                
            </div>		
        </div>
        <div class="col-md-12">
            
        </div>
    </div>
    
        <br>
    @empty
        {{ 'No estás inscrito en ninguna sesión' }}
    @endforelse

@stop

@section('css')

    <style type="text/css">
        .card-body {
            overflow: auto;
        }
        .bg-yellow-pfj{
            background-color: #ffb900!important;
            
        }
        .pgrupos .nav-tabs{
            border:0;
            overflow-y: hidden;
            overflow-x: auto;
        }
        .pgrupos .navbar{
            padding: 0
        }
        .pgrupos a.nav-item{
            color: white
        }
        .pgrupos a.nav-item:hover{
            background-color: #fe9a18 !important;
            border:0;
            margin:0;
            border-radius: 0;
        }
        .pgrupos a.nav-item.active{
            background-color: #fe9a18 !important;
            color:white!important;
            font-weight: bold;
            border:0;
            border-radius: 0;
            margin:0
        }
        .pgrupos .nav-link {
            display: block;
            padding: 1rem 1.5rem;
            font-size:
        }
        .nombre-sesion{
            max-width: 350px;
            min-width: 320px;
            width:100%;
            border:0 !important;
            margin:0;
            padding: 0.5rem 1.5rem;
            color: white;
            font-weight: bold;
            border-radius: 0;
            font-size: 27px;
            background-color: #fe9a18!important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .nombre-sesion:hover{
            color: white;
            background-color: #fe9a18!important;
        }

        .pgrupos .tab-pane{
            overflow: auto;
        }
        .pgrupos .nav{
            flex-wrap: unset;
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop