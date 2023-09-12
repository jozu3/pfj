<div class="row">
<div class="col-md-4">
	{!! Form::label('nombres', 'Nombre') !!}
	{!! Form::text('nombres', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del nuevo contacto']) !!}
	@error('nombres')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('apellidos', 'Apellidos') !!}
	{!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los apellidos del nuevo contacto']) !!}
	@error('apellidos')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	
	{!! Form::label('telefono', 'Teléfono') !!}
	{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el teléfono del nuevo contacto']) !!}
	@error('telefono')
		<small class="text-danger">{{ $message }}</small>
	@enderror

</div>
<div class="col-md-12">
	{!! Form::label('imgperfil', 'Imagen de perfil') !!}
	<div class="row p-2">
		<div class="col text-center">
			<img id="img-show" class="img-fluid" style="max-width: 25rem" src="@if ( isset($contacto)) @if(isset($contacto->image)) {{ Storage::url($contacto->image->url) }} @endif @endif"  alt="">
		</div>
		<div class="col">
			<div class="custom-file">
				{!! Form::file('imgperfil', ['class' => 'custom-file-input', 'accept' => 'image/*']) !!}
				<label class="custom-file-label" for="imgperfil">Escoge una foto</label>
			</div>
			<p>Solo se permite los formatos de imagen(jpg, png)</p>
			@error('imgperfil')
				<small class="text-danger">{{ $message }}</small>
			@enderror
		</div>
	</div>
</div>
<div class="col-md-4 mt-2">
	
	{!! Form::label('email', 'Correo electrónico') !!}
	{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email del nuevo contacto']) !!}
@error('email')
		<small class="text-danger">{{ $message }}</small>
@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('doc', 'DNI/CE') !!}
	{!! Form::text('doc', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el documento de identidad del nuevo contacto']) !!}
@error('doc')
		<small class="text-danger">{{ $message }}</small>
@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('genero', 'Género') !!}
	{!! Form::select('genero', [
			'Mujer' => 'Mujer',
			'Hombre' => 'Hombre',
		], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --']); !!}
	@error('genero')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('fecnac', 'Fecha de nacimiento') !!}
	{!! Form::date('fecnac', null, ['class' => 'form-control']); !!}
	@error('fecnac')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	<div class="border-top my-4"></div>
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('obispo', 'Obispo') !!}
	{!! Form::text('obispo', null, ['class' => 'form-control']); !!}
	@error('obispo')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('telobispo', 'Teléfono del Obispo') !!}
	{!! Form::text('telobispo', null, ['class' => 'form-control']); !!}
	@error('telobispo')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('email_obispo', 'Email del Obispo') !!}
	{!! Form::text('email_obispo', null, ['class' => 'form-control']); !!}
	@error('email_obispo')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('instituto', 'Asiste a instituto?') !!}
	{!! Form::text('instituto', null, ['class' => 'form-control']); !!}
	@error('instituto')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('llamamiento', 'Llamamiento') !!}
	{!! Form::text('llamamiento', null, ['class' => 'form-control']); !!}
	@error('llamamiento')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('mision', 'Misión') !!}
	{!! Form::text('mision', null, ['class' => 'form-control']); !!}
	@error('mision')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('mision', 'Recomendación para el templo') !!}
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			{!! Form::select(
				'mes_recomendacion',
				[
					'1' => 'Enero',
					'2' => 'Febrero',
					'3' => 'Marzo',
					'4' => 'Abril',
					'5' => 'Mayo',
					'6' => 'Junio',
					'7' => 'Julio',
					'8' => 'Agosto',
					'9' => 'Septiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre',
				],
				null,
				[
					'class' => 'form-control',
					'placeholder' => '-- Seleccione --',
				],
			) !!}
			{!! Form::number('anio_recomendacion', null, ['class' => 'form-control']) !!}
		</div>
	</div>
@error('mision')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>

<div class="col-md-12">
	<div class="border-top my-4"></div>
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('estudios', 'Qué estudios tienes?') !!}
	{!! Form::text('estudios', null, ['class' => 'form-control']); !!}
	@error('estudios')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('ocupacion', 'Trabajo o a qué se dedica') !!}
	{!! Form::text('ocupacion', null, ['class' => 'form-control']); !!}
	@error('ocupacion')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4 mt-2">
	{!! Form::label('primeros_auxilios', 'Conoce de primeros auxilios') !!}
	{!! Form::select('primeros_auxilios', [
		'1' => 'Sí',
		'0' => 'No',
	], null, ['class' => 'form-control']); !!}
	@error('primeros_auxilios')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-12">
	<div class="border-top my-4"></div>
</div>
 {{--  --}}
{{-- @if (auth()->user()->can('admin.contactos.asignarVendedor'))
<div class="col-md-1 mt-22">
	{!! Form::label('empleado_id', 'Vendedor') !!}
	{!! Form::select('empleado_id', $vendedores, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']); !!}
	@error('empleado_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
@else
{!! Form::hidden('empleado_id', null) !!}
@endif --}}

</div> 