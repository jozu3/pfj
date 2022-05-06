<div>
	@if ($pfjs->count())
		<div class="form-group">
			{!! Form::label('pfj_id', 'Pfj') !!}
			{!! Form::select('pfj_id', $pfjs, null, ['class' => 'form-control ', 'placeholder' => 'Escoge un pfj', 'wire:model' => 'pfj_id']); !!}
			@error('pfj_id')
				<small class="text-danger">{{ $message }}</small>
			@enderror
		</div> 
		<div class="form-group">
			{!! Form::label('programa_id', 'Sesión') !!}
			{!! Form::select('programa_id', $programas, null, ['class' => 'form-control', 'placeholder' => 'Escoga programa según fecha de inicio', 'wire:model' => 'programa_id']); !!}
			@error('programa_id')
				<small class="text-danger">{{ $message }}</small>
			@enderror
		</div> 
	@else
	    <div class="">
	        <b>No hay pfjs disponibles</b>        
	    </div>
	@endif
</div>