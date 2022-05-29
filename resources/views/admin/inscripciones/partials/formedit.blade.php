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
	<h5>
		
		<b>Funciones</b>
	</h4>
	<div class="form-row">
		@forelse ($inscripcione->programa->funciones as $funcione)
		<div class="col-1">
			{!! Form::checkbox('funciones[]', $funcione->id, null, ['class' => 'mr-1']) !!}
			{!! Form::label('funcion', $funcione->descripcion) !!}
		</div>
		@empty
			<div class="col">
				No ha creado funciones
			</div>
		@endforelse
		@error('funciones')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 
{{-- <div class="form-group">
	<div class="form-group">
		{!! Form::label('funcion', 'Función') !!}
		{!! Form::select('funcione_id', $inscripcione->programa->funciones->pluck('descripcion', 'id'), null, 
					['class' => 'form-control ', 'placeholder' => 'Escoge una función', 'wire:model' => 'funcione_id']); !!}
		@error('funcione_id')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div>  --}}


