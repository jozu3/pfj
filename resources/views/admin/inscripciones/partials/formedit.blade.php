<div class="form-group">
	<div class="form-group">
		{!! Form::label('role_id', 'Rol') !!}
		{!! Form::select('role_id', $roles, null, ['class' => 'form-control ', 'placeholder' => 'Escoge un rol', 'wire:model' => 'role_id']); !!}
		@error('role_id')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 
	{{-- <div class="form-check">
		@if (isset($inscripcione)) 
			@if ($inscripcione->tipoinscripcione == 0)
			@php
				$personale_nuevo = true;
			@endphp
			@endif
			@if ($inscripcione->tipoinscripcione == 1 || isset($personale_existe))
			@php
				$personale_antiguo = true;
			@endphp
			@endif
		@endif
	{!! Form::radio('tipoinscripcione', 0, $personale_nuevo, ['class' => 'form-check-input', 'id' =>'tm1']) !!} 
	{!! Form::label('tm1', 'Personale nuevo', ['class' => 'form-check-label']) !!}
	</div>
	<div class="form-check">
	{!! Form::radio('tipoinscripcione', 1, $personale_antiguo, ['class' => 'form-check-input', 'id' =>'tm2']) !!} 
	{!! Form::label('tm2', 'Personale antiguo', ['class' => 'form-check-label']) !!}
	</div>
	@error('tipoinscripcione')
		<small class="text-danger">{{ $message }}</small>
	@enderror --}}
	<div>
	@if(session('haypagos'))
		<small class="text-danger">{{ session('haypagos') }}</small>
	@endif
	</div>
</div> 