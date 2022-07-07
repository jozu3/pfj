<div class="form-group">
	<div class="form-group">
		{!! Form::label('nombre', 'Nombre') !!}
		{!! Form::text('nombre', null, ['class' => 'form-control ']) !!}
		@error('nombre')
			<small class="text-danger">{{ $message }}</small>
		@enderror
	</div> 	
</div> 
