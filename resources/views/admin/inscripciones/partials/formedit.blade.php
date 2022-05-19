<div class="form-group">
	<div class="form-group">
		{!! Form::label('role_id', 'Rol') !!}
		{!! Form::select('role_id', $roles, null, ['class' => 'form-control ', 'placeholder' => 'Escoge un rol', 'wire:model' => 'role_id']); !!}
		@error('role_id')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 

<div class="form-group">
	<div class="form-group">
		{!! Form::label('funcion', 'Función') !!}
		{!! Form::text('funcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese una función']) !!}
		@error('funcion')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 


