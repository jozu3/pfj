<div class="form-group">
	{!! Form::label('name', 'Nombre') !!}
	{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del nuevo permiso']) !!}
	@error('name')
		<small>{{$message}}</small>
	@enderror
</div> 
<div class="form-group">
	{!! Form::label('description', 'Descripción') !!}
	{!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción del nuevo permiso']) !!}
	@error('description')
		<small>{{$message}}</small>
	@enderror
</div> 
