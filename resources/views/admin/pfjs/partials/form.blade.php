<div class="row">
	<div class="col-md-12">
		{!! Form::label('nombre', 'Nombre') !!}
		{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del nuevo pfj']) !!}
		@error('nombre')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div>
	<div class="col-md-12">
		{!! Form::label('lema', 'Lema') !!}
		{!! Form::text('lema', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el lema del nuevo pfj']) !!}
		@error('lema')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div>
	<div class="col-md-12">
		{!! Form::label('lema_abreviado', 'Lema abreviado') !!}
		{!! Form::text('lema_abreviado', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el lema abreviado del nuevo pfj']) !!}
		@error('lema_abreviado')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div>
<div class="col-md-12">
	{!! Form::label('estado', 'Estado') !!}
	{!! Form::select('estado', [
			'0' => 'Discontinuado',
			'1' => 'Activo',
		], null, ['class' => 'form-control', 'placeholder' => 'Escoge']); !!}
	@error('estado')
		<small class="text-danger">{{ $message }}</small>
	@enderror
</div> 
</div> 