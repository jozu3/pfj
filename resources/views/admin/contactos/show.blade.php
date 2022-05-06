@extends('adminlte::page')

@section('title', 'PFJ')

@section('content_header')
	<a href="{{ route('admin.inscripciones.create', 'idcontacto='.$contacto->id) }}" class="btn btn-success btn-sm float-right">Inscribir</a>
    <h1>Contacto JAS: {{ $contacto->nombres.' '.$contacto->apellidos }}</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success">
        {{ session('info') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="row">		
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				{!! Form::model($contacto, ['route' => ['admin.contactos.update', $contacto], 'method' => 'put', 'files' => true]) !!}

				@include('admin.contactos.partials.form')
				<div class="row">
					
				<div class="col-md-12">
						{!! Form::label('estado', 'Estado') !!}
						{!! Form::select('estado', [
								'1' => 'No contactado',
								'2' => 'Contactado',
								'3' => 'Probable',
								'4' => 'Confirmado',
								'5' => 'Inscrito',
							], null, ['class' => 'form-control', 'placeholder' => 'Escoge', 'disabled' => 'disabled', 'style' => 'appearance: none; ']); !!}
				</div>
				</div>
				<br>
				<div class="form-group">
				{!! Form::submit('Actualizar datos', ['class' => 'btn btn-yellow-pfj']) !!}
				</div>
				{!! Form::close() !!}
				
			</div>
		</div>
		
	</div>
	@if ($contacto->personale != null)
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Información de personal</h5>
				</div>
				@php
					$personale = $contacto->personale;
				@endphp
				<div class="card-body">
					{!! Form::model($personale, ['route' => ['admin.personales.update', $personale], 'method' => 'put']) !!}
					{!! Form::hidden('show_contacto', '1')!!}

						@include('admin.personales.partials.form')
						
						{!! Form::submit('Guardar', ['class' => 'btn btn-yellow-pfj']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	@endif
	{{-- <div class="col-md-12">
		@livewire('admin.contacto-seguimientos', ['contacto' => $contacto])
	</div> --}}
</div>
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
		document.getElementById('imgperfil').addEventListener('change', cambiarImagen);

		function cambiarImagen(event){
			var file = event.target.files[0];

			var reader = new FileReader();
			reader.onload = (event) => {
				document.getElementById("img-show").setAttribute('src', event.target.result);
			};

			reader.readAsDataURL(file);
		}
	</script>
@stop