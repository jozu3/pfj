<div class="row">
<div class="col-md-4">
	{!! Form::label('nombres', 'Nombre') !!}
	{!! Form::text('nombres', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del nuevo contacto']) !!}
	@error('nombres')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4">
	{!! Form::label('apellidos', 'Apellidos') !!}
	{!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder' => 'Ingrese los apellidos del nuevo contacto']) !!}
	@error('apellidos')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-4">
	
	{!! Form::label('telefono', 'Teléfono') !!}
	{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el teléfono del nuevo contacto']) !!}
	@error('telefono')
		<small class="text-danger">{{ $message }}</small>
	@enderror

</div>
<div class="col-md-12">
	{!! Form::label('imgperfil', 'Imagen de perfil') !!}
	<div class="row p-2">
		<div class="col">
			<img id="img-show" class="img-fluid" src="@if ( isset($contacto)) @if(isset($contacto->image)) {{ Storage::url($contacto->image->url) }} @endif @endif"  alt="">
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
<div class="col-md-4">
	
	{!! Form::label('email', 'Correo electrónico') !!}
	{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email del nuevo contacto']) !!}
@error('email')
		<small class="text-danger">{{ $message }}</small>
@enderror
</div>
<div class="col-md-4">
	{!! Form::label('doc', 'DNI/CE') !!}
	{!! Form::text('doc', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el documento de identidad del nuevo contacto']) !!}
@error('doc')
		<small class="text-danger">{{ $message }}</small>
@enderror
</div>
<div class="col-md-6">
	{!! Form::label('genero', 'Género') !!}
	{!! Form::select('genero', [
			'Mujer' => 'Mujer',
			'Hombre' => 'Hombre',
		], null, ['class' => 'form-control', 'placeholder' => '-- Escoge --']); !!}
	@error('genero')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
<div class="col-md-6">
	{!! Form::label('fecnac', 'Fecha de nacimiento') !!}
	{!! Form::date('fecnac', null, ['class' => 'form-control']); !!}
	@error('fecnac')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
 {{--  --}}
{{-- @if (auth()->user()->can('admin.contactos.asignarVendedor'))
<div class="col-md-12">
	{!! Form::label('empleado_id', 'Vendedor') !!}
	{!! Form::select('empleado_id', $vendedores, null, ['class' => 'form-control', 'placeholder' => '-- Seleccione --']); !!}
	@error('empleado_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div>
@else
{!! Form::hidden('empleado_id', null) !!}
@endif --}}
{{-- <div class="col-md-6">
	{!! Form::label('estado', 'Estado') !!}
	{!! Form::select('estado', [
			'1' => 'No contactado',
			'2' => 'Contactado',
			'3' => 'Probable',
			'4' => 'Confirmado',
			'5' => 'Inscripcionedo',
		], null, ['class' => 'form-control', 'placeholder' => 'Escoge']); !!}
	@error('estado')
		<small class="text-danger">{{ $message }}</small>
	@enderror 
</div> --}}
</div> 