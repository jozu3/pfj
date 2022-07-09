<div class="form-group">
	<div class="form-group">
		{!! Form::label('nombre', 'Nombre') !!}
		{!! Form::text('nombre', null, ['class' => 'form-control ']) !!}
		@error('nombre')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 
<div class="form-group">
	<div class="form-group">
		{!! Form::label('pisos', 'Cantidad de pisos') !!}
		{!! Form::number('pisos', null, ['class' => 'form-control ']) !!}
		@error('pisos')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 
<div class="form-group">
	<div class="form-group">
		{!! Form::label('locale_id', 'Local') !!}
		{!! Form::select('locale_id', $locales, null, ['class' => 'form-control ']) !!}
		@error('locale_id')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 
