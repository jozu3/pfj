@extends('adminlte::page')

@section('title', 'Registrar pago')

@section('content_header')
    <h1>Registrar pago</h1>
@stop

@section('content')
	@if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
	<div class="card">
		<div class="card-body">
			{!! Form::open( ['route' => 'admin.pagos.store']) !!}
				<div class="row">
					@include('admin.pagos.partials.form')
					
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