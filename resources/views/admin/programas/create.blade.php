@extends('adminlte::page')

@section('title', 'Crear programa')

@section('content_header')
    <h1>Crear nueva sesión</h1>
@stop

@section('content')
	<div class="card">
		<div class="card-body">
			{!! Form::open(['route' => 'admin.programas.store', 'files' => true]) !!}
				{!! Form::hidden('pfj_id', $pfj->id) !!}
				
				@include('admin.programas.partials.form')
				
				<br>
				<div class="form-group">
					
				{!! Form::submit('Crear programa', ['class' => 'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('css')
    <style>
		.avatar-image{
            width:250px;
            height: 250px;
            object-fit: cover;
            object-position: center
        }
	</style>
@stop

@section('js')
    <script> 
		document.getElementById('imgMatrimonioDirector').addEventListener('change', cambiarImagen);
		document.getElementById('imgMatrimonioLogistica').addEventListener('change', cambiarImagen);

		function cambiarImagen(event){
			var file = event.target.files[0];
			console.log(event)
			var input = event.target
			var reader = new FileReader();
			reader.onload = (event) => {
				document.getElementById(input.getAttribute('data-img-show')).setAttribute('src', event.target.result);
			};

			reader.readAsDataURL(file);
		}
	</script>
@stop