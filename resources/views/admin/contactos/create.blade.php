@extends('adminlte::page')

@section('title', 'Crear contacto')

@section('content_header')
    <h1>Crear nuevo contacto</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.contactos.store', 'files' => true]) !!}
				
				@include('admin.contactos.partials.form')
				
				<br>
				<div class="form-group">
					
				{!! Form::submit('Crear contacto y agregar comentario', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('css')
    <link rel="stylesheet" href="">
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