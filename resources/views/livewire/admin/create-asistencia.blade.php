<div>
	@if (!$is_report)
   <div class="form-check">
	{!! Form::radio('asistencia', 0, null, ['class' => 'form-check-input disabled:opacity-25', 'id' =>'cl_a'.$capacitacione_id.$inscripcione_id, 'wire:click' => 'saveAsistencia', 'wire:model' => 'asistencia', 'wire:loading.attr' => 'disabled']) !!} 
	{!! Form::label('cl_a'.$capacitacione_id.$inscripcione_id, 'A', ['class' => 'form-check-label']) !!}
	</div>
	<div class="form-check">
	{!! Form::radio('asistencia', 1, null, ['class' => 'form-check-input disabled:opacity-25', 'id' =>'cl_f'.$capacitacione_id.$inscripcione_id, 'wire:click' => 'saveAsistencia', 'wire:model' => 'asistencia', 'wire:loading.attr' => 'disabled']) !!} 
	{!! Form::label('cl_f'.$capacitacione_id.$inscripcione_id, 'F', ['class' => 'form-check-label']) !!}
	</div>
	<div class="form-check">
	{!! Form::radio('asistencia', 2, null, ['class' => 'form-check-input disabled:opacity-25', 'id' =>'cl_fj'.$capacitacione_id.$inscripcione_id, 'wire:click' => 'saveAsistencia', 'wire:model' => 'asistencia', 'wire:loading.attr' => 'disabled']) !!} 
	{!! Form::label('cl_fj'.$capacitacione_id.$inscripcione_id, 'FJ', ['class' => 'form-check-label']) !!}
	</div>
 	@else
 		@switch($asistencia)
 		   @case('')
 				{{ '' }}
 		      @break
 		   @case(1)
 				{{ 'F' }}
 		      @break
 		   @case(2)
 				{{ 'FJ' }}
 		      @break
 		   @case(0)
 				{{ 'A' }}
 		      @break
 		   @default
 		      {{ '' }}
 		@endswitch
 	@endif
</div>
