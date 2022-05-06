<div class="form-group">
	{!! Form::label('descripcion', 'Descripción') !!}
	{!! Form::textArea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el anuncio']) !!}

	@error('descripcion')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('tipo', 'Tipo') !!}
	{!! Form::select('tipo', [
			'1' => 'Urgente',
			'2' => 'Informativo',
			'3' => 'Advertencia',
		], null, ['class' => 'form-control', 'placeholder' => '-- Escoge un tipo de anuncio --']); !!}
	@error('tipo')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('estado', 'Estado') !!}
	{!! Form::select('estado', [
			'1' => 'Activo',
			'2' => 'Inactivo',
		], null, ['class' => 'form-control', 'placeholder' => '-- Escoge un estado --']); !!}
	@error('estado')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('programa_id', 'Sesión') !!}
	{!! Form::select('programa_id', $programas, null, ['class' => 'form-control', 'placeholder' => '-- Escoge una sesión --']); !!}
	@error('programa_id')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 