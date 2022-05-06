@extends('adminlte::page')

@section('title', 'Editar nota')

@section('content_header')
    <a href="{{ route('admin.grupos.edit', $nota->unidad) }}" class="float-right">Volver a unidad: <b> {{$nota->unidad->descripcion}}</b>  <i class="fas fa-chevron-right"></i></a>
    <h1>Editar nota</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
	<div class="card">
		<div class="card-body">
			{!! Form::model($nota, ['route' => ['admin.notas.update', $nota], 'method' => 'put']) !!}
				<div class="row">
					
					@include('admin.notas.partials.form')
					
					<div class="col-md-12"><br>
						{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
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