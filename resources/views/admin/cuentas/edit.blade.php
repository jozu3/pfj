@extends('adminlte::page')

@section('title', 'Editar cuenta')

@section('content_header')
    <h1>Editar una cuenta</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
	<div class="card">
		<div class="card-body">
			{!! Form::model($cuenta, ['route' => ['admin.cuentas.update', $cuenta], 'method' => 'put']) !!}
				<div class="row">
					@include('admin.cuentas.partials.form')
					
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