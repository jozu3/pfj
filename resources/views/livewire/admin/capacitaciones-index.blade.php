<div>
	@if (session('info_capacitacione'))
        <div class="alert alert-success">
            {{ session('info_capacitacione') }}
        </div>
    @endif
	@if ($info_capacitacione != '')
        <div class="alert alert-success">
            {{ $info_capacitacione }}
        </div>
    @endif
    <table class="table table-striped">
    	<thead>
    		<tr>
    			<th>Tema de la Capacitación</th>
    			<th>Fecha</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($capacitaciones as $capacitacione)
    			<tr>
    				{!! Form::model($capacitacione, ['route' => ['admin.capacitaciones.update', $capacitacione], 'method' => 'put']) !!}
					{!!Form::hidden('programa_id', null) !!}
    				<td>
    					{!! Form::text('tema', null, ['class' => 'form-control']) !!}
					</td>
					<td>
						{!! Form::date('fechacapacitacion', null, ['class' => 'form-control']) !!}
					<td width="10px">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i></button>
    				</td>
    				{!! Form::close() !!}
					<td width="10px">
						<form method="POST" action="{{ route('admin.capacitaciones.destroy', $capacitacione) }}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger">
								<i class="fas fa-trash-alt"></i>
							</button>
						</form>
					</td>
    			</tr>
    		@endforeach

			<tr>
				<form wire:submit.prevent="submit">
				<td>
					<input type="text" name="tema" wire:model="tema" class="form-control">
					@error('tema')<small class="text-danger">{{ $message }}</small> @enderror
				</td>
				<td>
					<input type="date" name="fechacapacitacion" wire:model="fechacapacitacion" class="form-control">
					@error('fechacapacitacion')<small class="text-danger">{{ $message }}</small> @enderror
				</td>
				<td>
					<input type="submit" value="Guardar" wire:click="submit"  wire:loading.attr="disabled" wire:target="submit" class="btn btn-sm btn-primary disabled:opacity-25">
				</td>
				</form>
			</tr>
    	</tbody>
    </table>	
</div>
