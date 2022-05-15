@extends('adminlte::page')

@section('title', 'Crear Anuncio')

@section('content_header')
    <h1>Crear nuevo anuncio</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.anuncios.store']) !!}
				
				@include('admin.anuncios.partials.form')

				{!! Form::submit('Crear Anuncio', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
@stop

@section('js')
    <script> 
	 	document.getElementById('image').addEventListener('change', cambiarImagen);

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